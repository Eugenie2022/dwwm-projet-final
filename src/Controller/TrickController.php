<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Trick;
use App\Form\CommentType;
use App\Form\TrickType;
use App\Repository\CommentRepository;
use App\Repository\TrickRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/trick')]

class TrickController extends AbstractController
{

    #[Route('/', name: 'app_trick_index', methods: ['GET'])]
    public function index(TrickRepository $trickRepository): Response
    {
        return $this->render('trick/index.html.twig', [
            'tricks' => $trickRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_trick_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TrickRepository $trickRepository, FileUploader $fileUploader): Response
    {
        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setUserTrick($this->getUser());

            // Gérer l'upload de la photo
            /** @var UploadedFile $photoFile */
            $photoFile = $form->get('thumbnail')->getData();
            if ($photoFile) {
                $photoFileName = $fileUploader->upload($photoFile);
                $trick->setThumbnail($photoFileName);
            }

            $trickRepository->add($trick, true);
            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trick/new.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_trick_show', methods: ['GET', 'POST'])]
    public function show(Trick $trick, CommentRepository $commentRepository, Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUserCom($this->getUser());
            $comment->setCreatedAt(new \DateTimeImmutable());
            $comment->setTrickCom($trick);

            $commentRepository->add($comment, true);
            return $this->redirectToRoute('app_trick_show', ['id'=>$trick->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trick/show.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);

    }

    #[Route('/{id}/edit', name: 'app_trick_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Trick $trick, TrickRepository $trickRepository, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY') === false) {
            return $this->redirectToRoute('app_register');

        } if ($this->getUser() === $trick->getUserTrick() || $this->isGranted('ROLE_ADMIN')) {

            if ($form->isSubmitted() && $form->isValid()) {
                $trick->setUserTrick($this->getUser());

                // Gérer l'upload de la photo
                /** @var UploadedFile $photoFile */
                $photoFile = $form->get('thumbnail')->getData();
                if ($photoFile) {
                    $photoFileName = $fileUploader->upload($photoFile);
                    $trick->setThumbnail($photoFileName);
                }

                $trickRepository->add($trick, true);
                return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
            }

        } else {
            return $this->redirectToRoute('home', [], Response::HTTP_UNAUTHORIZED);
        }

            return $this->renderForm('trick/edit.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_trick_delete', methods: ['POST'])]
    public function delete(Request $request, Trick $trick, TrickRepository $trickRepository): Response
    {
        if ($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY') === false) {
            return $this->redirectToRoute('app_register');

        } if ($this->getUser() === $trick->getUserTrick() || $this->isGranted('ROLE_ADMIN')) {

            if ($this->isCsrfTokenValid('delete' . $trick->getId(), $request->request->get('_token'))) {
                $trickRepository->remove($trick, true);
            }
        } else {
            return $this->redirectToRoute('home');
        }

        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }


}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220523090926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name_cat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, trick_com_id INT NOT NULL, user_com_id INT NOT NULL, content LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_9474526C2F998E2A (trick_com_id), INDEX IDX_9474526C11DE140A (user_com_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, trick_media_id INT NOT NULL, path VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_6A2CA10C8F4C59CA (trick_media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trick (id INT AUTO_INCREMENT NOT NULL, user_trick_id INT NOT NULL, cat_trick_id INT NOT NULL, name_trick VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, thumbnail VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_D8F0A91E520C5A2E (user_trick_id), INDEX IDX_D8F0A91E30A9FB6D (cat_trick_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C2F998E2A FOREIGN KEY (trick_com_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C11DE140A FOREIGN KEY (user_com_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C8F4C59CA FOREIGN KEY (trick_media_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91E520C5A2E FOREIGN KEY (user_trick_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91E30A9FB6D FOREIGN KEY (cat_trick_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91E30A9FB6D');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C2F998E2A');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C8F4C59CA');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE trick');
    }
}

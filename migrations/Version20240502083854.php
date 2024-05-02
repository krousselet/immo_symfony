<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240502083854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, apartment_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_64C19C1176DFE85 (apartment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1176DFE85 FOREIGN KEY (apartment_id) REFERENCES apartment (id)');
        $this->addSql('ALTER TABLE pictures DROP FOREIGN KEY FK_8F7C2FC0176DFE85');
        $this->addSql('DROP INDEX IDX_8F7C2FC0176DFE85 ON pictures');
        $this->addSql('ALTER TABLE pictures DROP image_files, CHANGE description description VARCHAR(255) NOT NULL, CHANGE apartment_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT FK_8F7C2FC012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_8F7C2FC012469DE2 ON pictures (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pictures DROP FOREIGN KEY FK_8F7C2FC012469DE2');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1176DFE85');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP INDEX IDX_8F7C2FC012469DE2 ON pictures');
        $this->addSql('ALTER TABLE pictures ADD image_files JSON NOT NULL COMMENT \'(DC2Type:json)\', CHANGE description description LONGTEXT NOT NULL, CHANGE category_id apartment_id INT NOT NULL');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT FK_8F7C2FC0176DFE85 FOREIGN KEY (apartment_id) REFERENCES apartment (id)');
        $this->addSql('CREATE INDEX IDX_8F7C2FC0176DFE85 ON pictures (apartment_id)');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240505101646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE disponibilite (id INT AUTO_INCREMENT NOT NULL, appartement_id_id INT DEFAULT NULL, du DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', au DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2CBACE2F8236FDD6 (appartement_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, piece_id_id INT DEFAULT NULL, INDEX IDX_14B784186DF71F3C (piece_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece (id INT AUTO_INCREMENT NOT NULL, appartement_id_id INT NOT NULL, nom VARCHAR(100) NOT NULL, surface INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_44CA0B238236FDD6 (appartement_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE disponibilite ADD CONSTRAINT FK_2CBACE2F8236FDD6 FOREIGN KEY (appartement_id_id) REFERENCES apartment (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784186DF71F3C FOREIGN KEY (piece_id_id) REFERENCES piece (id)');
        $this->addSql('ALTER TABLE piece ADD CONSTRAINT FK_44CA0B238236FDD6 FOREIGN KEY (appartement_id_id) REFERENCES apartment (id)');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1176DFE85');
        $this->addSql('ALTER TABLE category_image DROP FOREIGN KEY FK_2D0E4B1612469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_image');
        $this->addSql('ALTER TABLE apartment CHANGE title titre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE contrat ADD appartement_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_603499938236FDD6 FOREIGN KEY (appartement_id_id) REFERENCES apartment (id)');
        $this->addSql('CREATE INDEX IDX_603499938236FDD6 ON contrat (appartement_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, apartment_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_64C19C1176DFE85 (apartment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE category_image (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, taille INT DEFAULT NULL, modification DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2D0E4B1612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1176DFE85 FOREIGN KEY (apartment_id) REFERENCES apartment (id)');
        $this->addSql('ALTER TABLE category_image ADD CONSTRAINT FK_2D0E4B1612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE disponibilite DROP FOREIGN KEY FK_2CBACE2F8236FDD6');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784186DF71F3C');
        $this->addSql('ALTER TABLE piece DROP FOREIGN KEY FK_44CA0B238236FDD6');
        $this->addSql('DROP TABLE disponibilite');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE piece');
        $this->addSql('ALTER TABLE apartment CHANGE titre title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_603499938236FDD6');
        $this->addSql('DROP INDEX IDX_603499938236FDD6 ON contrat');
        $this->addSql('ALTER TABLE contrat DROP appartement_id_id');
    }
}

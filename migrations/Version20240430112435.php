<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430112435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apartment_image (id INT AUTO_INCREMENT NOT NULL, apartment_image_id INT DEFAULT NULL, apartment_id INT NOT NULL, INDEX IDX_82FA5792304479BD (apartment_image_id), INDEX IDX_82FA5792176DFE85 (apartment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apartment_image ADD CONSTRAINT FK_82FA5792304479BD FOREIGN KEY (apartment_image_id) REFERENCES apartment (id)');
        $this->addSql('ALTER TABLE apartment_image ADD CONSTRAINT FK_82FA5792176DFE85 FOREIGN KEY (apartment_id) REFERENCES apartment (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apartment_image DROP FOREIGN KEY FK_82FA5792304479BD');
        $this->addSql('ALTER TABLE apartment_image DROP FOREIGN KEY FK_82FA5792176DFE85');
        $this->addSql('DROP TABLE apartment_image');
    }
}

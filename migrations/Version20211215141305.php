<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211215141305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chantiers (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, date_de_debut DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pointages (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, chantier_id INT NOT NULL, date DATETIME NOT NULL, duree INT NOT NULL, INDEX IDX_2067B6D8FB88E14F (utilisateur_id), INDEX IDX_2067B6D8D0C0049D (chantier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pointages ADD CONSTRAINT FK_2067B6D8FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE pointages ADD CONSTRAINT FK_2067B6D8D0C0049D FOREIGN KEY (chantier_id) REFERENCES chantiers (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pointages DROP FOREIGN KEY FK_2067B6D8D0C0049D');
        $this->addSql('ALTER TABLE pointages DROP FOREIGN KEY FK_2067B6D8FB88E14F');
        $this->addSql('DROP TABLE chantiers');
        $this->addSql('DROP TABLE pointages');
        $this->addSql('DROP TABLE utilisateur');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200704103920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE batiment (id INT AUTO_INCREMENT NOT NULL, num_bat INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, num_bat_id INT NOT NULL, num_chambre INT NOT NULL, INDEX IDX_C509E4FF94D02D5E (num_bat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, boursier_id INT DEFAULT NULL, loge_id INT DEFAULT NULL, non_loge_id INT DEFAULT NULL, matricule VARCHAR(30) NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(50) NOT NULL, date_naiss DATE NOT NULL, email VARCHAR(50) NOT NULL, telephone INT DEFAULT NULL, UNIQUE INDEX UNIQ_717E22E3EC0DC9B3 (boursier_id), UNIQUE INDEX UNIQ_717E22E39632F42E (loge_id), UNIQUE INDEX UNIQ_717E22E35A30C323 (non_loge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant_boursier (id INT AUTO_INCREMENT NOT NULL, motant_bourse INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant_loge (id INT AUTO_INCREMENT NOT NULL, chambre_id INT NOT NULL, INDEX IDX_547AD4419B177F54 (chambre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant_non_boursier (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF94D02D5E FOREIGN KEY (num_bat_id) REFERENCES batiment (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3EC0DC9B3 FOREIGN KEY (boursier_id) REFERENCES etudiant_boursier (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E39632F42E FOREIGN KEY (loge_id) REFERENCES etudiant_loge (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E35A30C323 FOREIGN KEY (non_loge_id) REFERENCES etudiant_non_boursier (id)');
        $this->addSql('ALTER TABLE etudiant_loge ADD CONSTRAINT FK_547AD4419B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF94D02D5E');
        $this->addSql('ALTER TABLE etudiant_loge DROP FOREIGN KEY FK_547AD4419B177F54');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3EC0DC9B3');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E39632F42E');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E35A30C323');
        $this->addSql('DROP TABLE batiment');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE etudiant_boursier');
        $this->addSql('DROP TABLE etudiant_loge');
        $this->addSql('DROP TABLE etudiant_non_boursier');
    }
}

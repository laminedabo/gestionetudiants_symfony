<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200705161933 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE batiment ADD nom VARCHAR(30) DEFAULT NULL');
        $this->addSql('ALTER TABLE chambre ADD type VARCHAR(20) NOT NULL, CHANGE num_chambre num_chambre INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE batiment DROP nom');
        $this->addSql('ALTER TABLE chambre DROP type, CHANGE num_chambre num_chambre INT DEFAULT NULL');
    }
}

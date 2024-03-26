<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240325211651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, cv VARCHAR(255) DEFAULT NULL, lettre_motivation VARCHAR(255) DEFAULT NULL, profession VARCHAR(255) NOT NULL, id_utilisateur_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_6AB5B471C6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, secteur_activite VARCHAR(255) NOT NULL, num_siret VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, statut_compte VARCHAR(255) DEFAULT NULL, adresse LONGTEXT NOT NULL, id_utilisateur_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_D19FA60C6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471C6EE5C49');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60C6EE5C49');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE entreprise');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240327213855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidature (id INT AUTO_INCREMENT NOT NULL, statut_candidature VARCHAR(255) NOT NULL, id_offre_id INT DEFAULT NULL, id_candidat_id INT DEFAULT NULL, INDEX IDX_E33BD3B81C13BCCF (id_offre_id), INDEX IDX_E33BD3B810C22675 (id_candidat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, salaire VARCHAR(255) DEFAULT NULL, etude_min VARCHAR(255) NOT NULL, experience_min VARCHAR(255) NOT NULL, type_contrat VARCHAR(255) NOT NULL, nb_heure VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prerequis LONGTEXT NOT NULL, id_entreprise_id INT DEFAULT NULL, INDEX IDX_AF86866F1A867E8F (id_entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B81C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B810C22675 FOREIGN KEY (id_candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F1A867E8F FOREIGN KEY (id_entreprise_id) REFERENCES entreprise (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B81C13BCCF');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B810C22675');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F1A867E8F');
        $this->addSql('DROP TABLE candidature');
        $this->addSql('DROP TABLE offre');
    }
}

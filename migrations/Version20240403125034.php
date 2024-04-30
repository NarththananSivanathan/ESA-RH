<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240403125034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recruteur (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, entreprise_id INT NOT NULL, civilite VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, roles JSON NOT NULL, date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', post VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2BD3678CE7927C74 (email), INDEX IDX_2BD3678C4DE7DC5C (adresse_id), INDEX IDX_2BD3678CA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recruteur ADD CONSTRAINT FK_2BD3678C4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE recruteur ADD CONSTRAINT FK_2BD3678CA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recruteur DROP FOREIGN KEY FK_2BD3678C4DE7DC5C');
        $this->addSql('ALTER TABLE recruteur DROP FOREIGN KEY FK_2BD3678CA4AEAFEA');
        $this->addSql('DROP TABLE recruteur');
    }
}

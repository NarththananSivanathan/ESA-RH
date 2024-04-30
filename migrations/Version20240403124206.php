<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240403124206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76C6EE5C49');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60C6EE5C49');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471C6EE5C49');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B34DE7DC5C');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP INDEX UNIQ_880E0D76C6EE5C49 ON `admin`');
        $this->addSql('ALTER TABLE `admin` ADD civilite VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD mot_de_passe VARCHAR(255) NOT NULL, ADD roles JSON NOT NULL, ADD date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE id_utilisateur_id adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D764DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76E7927C74 ON `admin` (email)');
        $this->addSql('CREATE INDEX IDX_880E0D764DE7DC5C ON `admin` (adresse_id)');
        $this->addSql('DROP INDEX UNIQ_6AB5B471C6EE5C49 ON candidat');
        $this->addSql('ALTER TABLE candidat ADD civilite VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD mot_de_passe VARCHAR(255) NOT NULL, ADD roles JSON NOT NULL, ADD date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE id_utilisateur_id adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B4714DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AB5B471E7927C74 ON candidat (email)');
        $this->addSql('CREATE INDEX IDX_6AB5B4714DE7DC5C ON candidat (adresse_id)');
        $this->addSql('DROP INDEX UNIQ_D19FA60C6EE5C49 ON entreprise');
        $this->addSql('ALTER TABLE entreprise DROP id_utilisateur_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, civilite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, mot_de_passe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1D1C63B34DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B34DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D764DE7DC5C');
        $this->addSql('DROP INDEX UNIQ_880E0D76E7927C74 ON `admin`');
        $this->addSql('DROP INDEX IDX_880E0D764DE7DC5C ON `admin`');
        $this->addSql('ALTER TABLE `admin` DROP civilite, DROP prenom, DROP nom, DROP email, DROP mot_de_passe, DROP roles, DROP date_inscription, CHANGE adresse_id id_utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76C6EE5C49 ON `admin` (id_utilisateur_id)');
        $this->addSql('ALTER TABLE entreprise ADD id_utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D19FA60C6EE5C49 ON entreprise (id_utilisateur_id)');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B4714DE7DC5C');
        $this->addSql('DROP INDEX UNIQ_6AB5B471E7927C74 ON candidat');
        $this->addSql('DROP INDEX IDX_6AB5B4714DE7DC5C ON candidat');
        $this->addSql('ALTER TABLE candidat DROP civilite, DROP prenom, DROP nom, DROP email, DROP mot_de_passe, DROP roles, DROP date_inscription, CHANGE adresse_id id_utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AB5B471C6EE5C49 ON candidat (id_utilisateur_id)');
    }
}

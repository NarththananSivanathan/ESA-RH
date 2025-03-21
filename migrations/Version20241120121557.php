<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120121557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, civilite VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', login_count INT NOT NULL, password1 VARCHAR(255) DEFAULT NULL, password2 VARCHAR(255) NOT NULL, poste VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), INDEX IDX_880E0D764DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, civilite VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', login_count INT NOT NULL, password1 VARCHAR(255) DEFAULT NULL, password2 VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, cv VARCHAR(255) DEFAULT NULL, lettre_de_motivation VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_6AB5B471E7927C74 (email), INDEX IDX_6AB5B4714DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidature (id INT AUTO_INCREMENT NOT NULL, id_offre_id INT DEFAULT NULL, id_candidat_id INT DEFAULT NULL, statut_candidature VARCHAR(255) NOT NULL, message LONGTEXT DEFAULT NULL, cv VARCHAR(255) DEFAULT NULL, lettre_de_motivation VARCHAR(255) DEFAULT NULL, date_candidature DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E33BD3B81C13BCCF (id_offre_id), INDEX IDX_E33BD3B810C22675 (id_candidat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, code_naf VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, telephone2 VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, is_valid TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, id_entreprise_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, salaire VARCHAR(255) DEFAULT NULL, etude_min VARCHAR(255) NOT NULL, experience_min VARCHAR(255) NOT NULL, type_contrat VARCHAR(255) NOT NULL, nb_heure VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prerequis LONGTEXT NOT NULL, date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_AF86866F1A867E8F (id_entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recruteur (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, entreprise_id INT NOT NULL, civilite VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', login_count INT NOT NULL, password1 VARCHAR(255) DEFAULT NULL, password2 VARCHAR(255) NOT NULL, post VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2BD3678CE7927C74 (email), INDEX IDX_2BD3678C4DE7DC5C (adresse_id), INDEX IDX_2BD3678CA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D764DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B4714DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B81C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B810C22675 FOREIGN KEY (id_candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F1A867E8F FOREIGN KEY (id_entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE recruteur ADD CONSTRAINT FK_2BD3678C4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE recruteur ADD CONSTRAINT FK_2BD3678CA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D764DE7DC5C');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B4714DE7DC5C');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B81C13BCCF');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B810C22675');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F1A867E8F');
        $this->addSql('ALTER TABLE recruteur DROP FOREIGN KEY FK_2BD3678C4DE7DC5C');
        $this->addSql('ALTER TABLE recruteur DROP FOREIGN KEY FK_2BD3678CA4AEAFEA');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE candidature');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE recruteur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

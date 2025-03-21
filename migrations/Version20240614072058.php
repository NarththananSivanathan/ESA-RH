<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240614072058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` ADD login_count INT NOT NULL, ADD password1 VARCHAR(255) DEFAULT NULL, ADD password2 VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE candidat ADD login_count INT NOT NULL, ADD password1 VARCHAR(255) DEFAULT NULL, ADD password2 VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE recruteur ADD login_count INT NOT NULL, ADD password1 VARCHAR(255) DEFAULT NULL, ADD password2 VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recruteur DROP login_count, DROP password1, DROP password2');
        $this->addSql('ALTER TABLE `admin` DROP login_count, DROP password1, DROP password2');
        $this->addSql('ALTER TABLE candidat DROP login_count, DROP password1, DROP password2');
    }
}

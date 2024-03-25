<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240325214446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_candidat DROP FOREIGN KEY FK_51774FCA4CC8505A');
        $this->addSql('ALTER TABLE offre_candidat DROP FOREIGN KEY FK_51774FCA8D0EB82');
        $this->addSql('DROP TABLE offre_candidat');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offre_candidat (offre_id INT NOT NULL, candidat_id INT NOT NULL, INDEX IDX_51774FCA4CC8505A (offre_id), INDEX IDX_51774FCA8D0EB82 (candidat_id), PRIMARY KEY(offre_id, candidat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE offre_candidat ADD CONSTRAINT FK_51774FCA4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_candidat ADD CONSTRAINT FK_51774FCA8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}

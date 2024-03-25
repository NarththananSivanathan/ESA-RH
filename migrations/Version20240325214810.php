<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240325214810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat ADD offre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B4714CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_6AB5B4714CC8505A ON candidat (offre_id)');
        $this->addSql('ALTER TABLE offre ADD candidat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('CREATE INDEX IDX_AF86866F8D0EB82 ON offre (candidat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F8D0EB82');
        $this->addSql('DROP INDEX IDX_AF86866F8D0EB82 ON offre');
        $this->addSql('ALTER TABLE offre DROP candidat_id');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B4714CC8505A');
        $this->addSql('DROP INDEX IDX_6AB5B4714CC8505A ON candidat');
        $this->addSql('ALTER TABLE candidat DROP offre_id');
    }
}

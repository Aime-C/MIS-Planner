<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250926120839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe_membres (equipe_id INT NOT NULL, membres_id INT NOT NULL, INDEX IDX_814AFF206D861B89 (equipe_id), INDEX IDX_814AFF2071128C5C (membres_id), PRIMARY KEY(equipe_id, membres_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipe_membres ADD CONSTRAINT FK_814AFF206D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_membres ADD CONSTRAINT FK_814AFF2071128C5C FOREIGN KEY (membres_id) REFERENCES membres (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe_membres DROP FOREIGN KEY FK_814AFF206D861B89');
        $this->addSql('ALTER TABLE equipe_membres DROP FOREIGN KEY FK_814AFF2071128C5C');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE equipe_membres');
    }
}

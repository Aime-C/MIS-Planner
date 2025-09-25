<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250925091604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, chef TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_membres (role_id INT NOT NULL, membres_id INT NOT NULL, INDEX IDX_E5874667D60322AC (role_id), INDEX IDX_E587466771128C5C (membres_id), PRIMARY KEY(role_id, membres_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role_membres ADD CONSTRAINT FK_E5874667D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_membres ADD CONSTRAINT FK_E587466771128C5C FOREIGN KEY (membres_id) REFERENCES membres (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role_membres DROP FOREIGN KEY FK_E5874667D60322AC');
        $this->addSql('ALTER TABLE role_membres DROP FOREIGN KEY FK_E587466771128C5C');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_membres');
    }
}

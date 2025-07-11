<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250709075708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE marques (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE membres (id INT AUTO_INCREMENT NOT NULL, rank_id INT NOT NULL, pseudo VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, join_date DATETIME NOT NULL, is_actif INT DEFAULT 1 NOT NULL, INDEX IDX_594AE39C7616678F (rank_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `rank` (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, hierachie INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vaisseaux (id INT AUTO_INCREMENT NOT NULL, size_category_id INT NOT NULL, marque_id INT NOT NULL, type_id INT NOT NULL, nom VARCHAR(255) NOT NULL, realease_date DATETIME NOT NULL, is_released TINYINT(1) NOT NULL, height DOUBLE PRECISION DEFAULT NULL, width DOUBLE PRECISION DEFAULT NULL, length DOUBLE PRECISION DEFAULT NULL, scu INT NOT NULL, image VARCHAR(1000) DEFAULT NULL, poster VARCHAR(1000) DEFAULT NULL, INDEX IDX_1D60300932F3F7D2 (size_category_id), INDEX IDX_1D6030094827B9B2 (marque_id), INDEX IDX_1D603009C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vaisseaux_membres (id INT AUTO_INCREMENT NOT NULL, vaisseau_id INT NOT NULL, membre_id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, INDEX IDX_AAAE0F17520A1B0 (vaisseau_id), INDEX IDX_AAAE0F16A99F74A (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE membres ADD CONSTRAINT FK_594AE39C7616678F FOREIGN KEY (rank_id) REFERENCES `rank` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vaisseaux ADD CONSTRAINT FK_1D60300932F3F7D2 FOREIGN KEY (size_category_id) REFERENCES size (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vaisseaux ADD CONSTRAINT FK_1D6030094827B9B2 FOREIGN KEY (marque_id) REFERENCES marques (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vaisseaux ADD CONSTRAINT FK_1D603009C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vaisseaux_membres ADD CONSTRAINT FK_AAAE0F17520A1B0 FOREIGN KEY (vaisseau_id) REFERENCES vaisseaux (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vaisseaux_membres ADD CONSTRAINT FK_AAAE0F16A99F74A FOREIGN KEY (membre_id) REFERENCES membres (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE membres DROP FOREIGN KEY FK_594AE39C7616678F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vaisseaux DROP FOREIGN KEY FK_1D60300932F3F7D2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vaisseaux DROP FOREIGN KEY FK_1D6030094827B9B2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vaisseaux DROP FOREIGN KEY FK_1D603009C54C8C93
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vaisseaux_membres DROP FOREIGN KEY FK_AAAE0F17520A1B0
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vaisseaux_membres DROP FOREIGN KEY FK_AAAE0F16A99F74A
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE marques
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE membres
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `rank`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE size
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE type
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vaisseaux
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vaisseaux_membres
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}

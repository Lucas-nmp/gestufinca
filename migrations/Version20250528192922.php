<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250528192922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE community (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, number INT NOT NULL, locality VARCHAR(255) NOT NULL, neighbors_count INT NOT NULL, id_neighbor INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE neighbor (id INT AUTO_INCREMENT NOT NULL, community_id INT DEFAULT NULL, fullname VARCHAR(255) NOT NULL, dni VARCHAR(9) NOT NULL, phone VARCHAR(9) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_948B5CB7FDA7B0BF (community_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE neighbor ADD CONSTRAINT FK_948B5CB7FDA7B0BF FOREIGN KEY (community_id) REFERENCES community (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information ADD community_id INT NOT NULL, DROP community
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information ADD CONSTRAINT FK_29791883FDA7B0BF FOREIGN KEY (community_id) REFERENCES community (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_29791883FDA7B0BF ON information (community_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE information DROP FOREIGN KEY FK_29791883FDA7B0BF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE neighbor DROP FOREIGN KEY FK_948B5CB7FDA7B0BF
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE community
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE neighbor
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_29791883FDA7B0BF ON information
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE information ADD community VARCHAR(255) NOT NULL, DROP community_id
        SQL);
    }
}

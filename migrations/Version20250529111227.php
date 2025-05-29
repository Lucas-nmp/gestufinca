<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250529111227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD community_id INT DEFAULT NULL, ADD full_name VARCHAR(255) NOT NULL, ADD president TINYINT(1) NOT NULL, ADD dni VARCHAR(9) NOT NULL, ADD phone VARCHAR(9) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D649FDA7B0BF FOREIGN KEY (community_id) REFERENCES community (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8D93D649FDA7B0BF ON user (community_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FDA7B0BF
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8D93D649FDA7B0BF ON user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP community_id, DROP full_name, DROP president, DROP dni, DROP phone
        SQL);
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220429075227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76F85E0677 ON admin (username)');
        $this->addSql('DROP INDEX IDX_527EDB25979B1AD6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__task AS SELECT id, company_id, description, url, time, deadline, finished FROM task');
        $this->addSql('DROP TABLE task');
        $this->addSql('CREATE TABLE task (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, company_id INTEGER DEFAULT NULL, description CLOB NOT NULL, url VARCHAR(255) DEFAULT NULL, time INTEGER DEFAULT NULL, deadline DATE DEFAULT NULL, finished BOOLEAN NOT NULL, CONSTRAINT FK_527EDB25979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO task (id, company_id, description, url, time, deadline, finished) SELECT id, company_id, description, url, time, deadline, finished FROM __temp__task');
        $this->addSql('DROP TABLE __temp__task');
        $this->addSql('CREATE INDEX IDX_527EDB25979B1AD6 ON task (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP INDEX IDX_527EDB25979B1AD6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__task AS SELECT id, company_id, description, url, time, deadline, finished FROM task');
        $this->addSql('DROP TABLE task');
        $this->addSql('CREATE TABLE task (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, company_id INTEGER DEFAULT NULL, description CLOB NOT NULL, url VARCHAR(255) DEFAULT NULL, time INTEGER DEFAULT NULL, deadline DATE DEFAULT NULL, finished BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO task (id, company_id, description, url, time, deadline, finished) SELECT id, company_id, description, url, time, deadline, finished FROM __temp__task');
        $this->addSql('DROP TABLE __temp__task');
        $this->addSql('CREATE INDEX IDX_527EDB25979B1AD6 ON task (company_id)');
    }
}

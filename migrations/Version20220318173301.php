<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220318173301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE calendar_account_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE calendar_account (id INT NOT NULL, calendar_user_id INT NOT NULL, source VARCHAR(10) NOT NULL, access_token VARCHAR(2048) DEFAULT NULL, refresh_token VARCHAR(512) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1F412D63C519A852 ON calendar_account (calendar_user_id)');
        $this->addSql('ALTER TABLE calendar_account ADD CONSTRAINT FK_1F412D63C519A852 FOREIGN KEY (calendar_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE calendar_account_id_seq CASCADE');
        $this->addSql('DROP TABLE calendar_account');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210411102800 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX id ON mailbox');
        $this->addSql('DROP INDEX id_2 ON mailbox');
        $this->addSql('ALTER TABLE user CHANGE phone phone VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE web_site_footer CHANGE phone phone VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX id ON mailbox (id)');
        $this->addSql('CREATE INDEX id_2 ON mailbox (id)');
        $this->addSql('ALTER TABLE user CHANGE phone phone INT DEFAULT NULL');
        $this->addSql('ALTER TABLE web_site_footer CHANGE phone phone INT NOT NULL');
    }
}

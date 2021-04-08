<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210408133054 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE web_site_menu_pro (id INT AUTO_INCREMENT NOT NULL, button1 VARCHAR(40) DEFAULT NULL, button2 VARCHAR(40) DEFAULT NULL, link1 VARCHAR(40) DEFAULT NULL, link2 VARCHAR(40) DEFAULT NULL, button3 VARCHAR(40) DEFAULT NULL, link3 VARCHAR(40) DEFAULT NULL, button4 VARCHAR(40) DEFAULT NULL, link4 VARCHAR(40) DEFAULT NULL, button5 VARCHAR(40) DEFAULT NULL, link5 VARCHAR(40) DEFAULT NULL, icon1 VARCHAR(40) DEFAULT NULL, icon2 VARCHAR(40) DEFAULT NULL, icon3 VARCHAR(40) DEFAULT NULL, icon4 VARCHAR(40) DEFAULT NULL, icon5 VARCHAR(40) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE web_site_menu_pro');
    }
}

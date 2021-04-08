<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210408124127 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE web_site_menu_admin CHANGE button1 button1 VARCHAR(40) DEFAULT NULL, CHANGE button2 button2 VARCHAR(40) DEFAULT NULL, CHANGE link1 link1 VARCHAR(40) DEFAULT NULL, CHANGE link2 link2 VARCHAR(40) DEFAULT NULL, CHANGE button3 button3 VARCHAR(40) DEFAULT NULL, CHANGE link3 link3 VARCHAR(40) DEFAULT NULL, CHANGE button4 button4 VARCHAR(40) DEFAULT NULL, CHANGE link4 link4 VARCHAR(40) DEFAULT NULL, CHANGE button5 button5 VARCHAR(40) DEFAULT NULL, CHANGE button6 button6 VARCHAR(40) DEFAULT NULL, CHANGE button7 button7 VARCHAR(40) DEFAULT NULL, CHANGE link5 link5 VARCHAR(40) DEFAULT NULL, CHANGE link6 link6 VARCHAR(40) DEFAULT NULL, CHANGE link7 link7 VARCHAR(40) DEFAULT NULL, CHANGE icon1 icon1 VARCHAR(40) DEFAULT NULL, CHANGE icon2 icon2 VARCHAR(40) DEFAULT NULL, CHANGE icon3 icon3 VARCHAR(40) DEFAULT NULL, CHANGE icon4 icon4 VARCHAR(40) DEFAULT NULL, CHANGE icon5 icon5 VARCHAR(40) DEFAULT NULL, CHANGE icon6 icon6 VARCHAR(40) DEFAULT NULL, CHANGE icon7 icon7 VARCHAR(40) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE web_site_menu_admin CHANGE button1 button1 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE button2 button2 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link1 link1 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link2 link2 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE button3 button3 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link3 link3 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE button4 button4 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link4 link4 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE button5 button5 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE button6 button6 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE button7 button7 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link5 link5 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link6 link6 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link7 link7 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon1 icon1 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon2 icon2 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon3 icon3 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon4 icon4 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon5 icon5 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon6 icon6 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon7 icon7 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

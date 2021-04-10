<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210410121228 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX id ON avatar');
        $this->addSql('DROP INDEX id_2 ON avatar');
        $this->addSql('DROP INDEX id ON mailbox');
        $this->addSql('DROP INDEX id_2 ON mailbox');
        $this->addSql('DROP INDEX id ON `option`');
        $this->addSql('DROP INDEX id_2 ON `option`');
        $this->addSql('DROP INDEX id_3 ON `option`');
        $this->addSql('DROP INDEX id ON optionrent');
        $this->addSql('DROP INDEX id_2 ON optionrent');
        $this->addSql('DROP INDEX id ON picture');
        $this->addSql('DROP INDEX id ON picture_rent');
        $this->addSql('DROP INDEX id ON property');
        $this->addSql('DROP INDEX id_2 ON property');
        $this->addSql('DROP INDEX property_id ON property_option');
        $this->addSql('DROP INDEX id ON rent');
        $this->addSql('DROP INDEX id_2 ON rent');
        $this->addSql('DROP INDEX rent_id ON rent_option_rent');
        $this->addSql('DROP INDEX id ON user');
        $this->addSql('DROP INDEX id ON web_site_footer');
        $this->addSql('ALTER TABLE web_site_footer CHANGE facebook facebook VARCHAR(40) DEFAULT NULL, CHANGE twitter twitter VARCHAR(40) DEFAULT NULL, CHANGE instagram instagram VARCHAR(40) DEFAULT NULL, CHANGE linkedin linkedin VARCHAR(40) DEFAULT NULL, CHANGE city city VARCHAR(40) DEFAULT NULL');
        $this->addSql('DROP INDEX id ON web_site_header');
        $this->addSql('DROP INDEX id ON web_site_menu');
        $this->addSql('ALTER TABLE web_site_menu CHANGE button1 button1 VARCHAR(40) DEFAULT NULL, CHANGE button2 button2 VARCHAR(40) DEFAULT NULL, CHANGE button3 button3 VARCHAR(40) DEFAULT NULL, CHANGE button4 button4 VARCHAR(40) DEFAULT NULL, CHANGE button5 button5 VARCHAR(40) DEFAULT NULL, CHANGE link1 link1 VARCHAR(40) DEFAULT NULL, CHANGE link2 link2 VARCHAR(40) DEFAULT NULL, CHANGE link3 link3 VARCHAR(40) DEFAULT NULL, CHANGE link4 link4 VARCHAR(40) DEFAULT NULL, CHANGE link5 link5 VARCHAR(40) DEFAULT NULL');
        $this->addSql('DROP INDEX id ON web_site_menu2');
        $this->addSql('ALTER TABLE web_site_menu2 CHANGE button1 button1 VARCHAR(40) DEFAULT NULL, CHANGE button2 button2 VARCHAR(40) DEFAULT NULL, CHANGE link1 link1 VARCHAR(40) DEFAULT NULL, CHANGE link2 link2 VARCHAR(40) DEFAULT NULL, CHANGE button3 button3 VARCHAR(40) DEFAULT NULL, CHANGE link3 link3 VARCHAR(40) DEFAULT NULL, CHANGE button4 button4 VARCHAR(40) DEFAULT NULL, CHANGE link4 link4 VARCHAR(40) DEFAULT NULL');
        $this->addSql('DROP INDEX id ON web_site_menu_admin');
        $this->addSql('DROP INDEX id ON web_site_menu_pro');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX id ON avatar (id)');
        $this->addSql('CREATE INDEX id_2 ON avatar (id)');
        $this->addSql('CREATE UNIQUE INDEX id ON mailbox (id)');
        $this->addSql('CREATE INDEX id_2 ON mailbox (id)');
        $this->addSql('CREATE UNIQUE INDEX id ON `option` (id)');
        $this->addSql('CREATE INDEX id_2 ON `option` (id)');
        $this->addSql('CREATE INDEX id_3 ON `option` (id)');
        $this->addSql('CREATE INDEX id ON `optionrent` (id)');
        $this->addSql('CREATE INDEX id_2 ON `optionrent` (id)');
        $this->addSql('CREATE INDEX id ON picture (id)');
        $this->addSql('CREATE INDEX id ON picture_rent (id)');
        $this->addSql('CREATE INDEX id ON property (id)');
        $this->addSql('CREATE INDEX id_2 ON property (id)');
        $this->addSql('CREATE INDEX property_id ON property_option (property_id)');
        $this->addSql('CREATE INDEX id ON rent (id)');
        $this->addSql('CREATE INDEX id_2 ON rent (id)');
        $this->addSql('CREATE INDEX rent_id ON rent_option_rent (rent_id)');
        $this->addSql('CREATE INDEX id ON user (id)');
        $this->addSql('ALTER TABLE web_site_footer CHANGE facebook facebook VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE twitter twitter VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE instagram instagram VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE linkedin linkedin VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE INDEX id ON web_site_footer (id)');
        $this->addSql('CREATE INDEX id ON web_site_header (id)');
        $this->addSql('ALTER TABLE web_site_menu CHANGE button1 button1 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE button2 button2 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE button3 button3 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE button4 button4 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE button5 button5 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link1 link1 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link2 link2 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link3 link3 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link4 link4 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link5 link5 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE INDEX id ON web_site_menu (id)');
        $this->addSql('ALTER TABLE web_site_menu2 CHANGE button1 button1 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE button2 button2 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link1 link1 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link2 link2 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE button3 button3 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link3 link3 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE button4 button4 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link4 link4 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE INDEX id ON web_site_menu2 (id)');
        $this->addSql('CREATE INDEX id ON web_site_menu_admin (id)');
        $this->addSql('CREATE INDEX id ON web_site_menu_pro (id)');
    }
}

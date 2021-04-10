<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210410045148 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, filename VARCHAR(255) NOT NULL, INDEX IDX_1677722FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mailbox (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, is_read TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, favorite TINYINT(1) NOT NULL, important TINYINT(1) NOT NULL, trash TINYINT(1) NOT NULL, categorie TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `optionrent` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, property_id INT NOT NULL, filename VARCHAR(255) NOT NULL, INDEX IDX_16DB4F89549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture_rent (id INT AUTO_INCREMENT NOT NULL, rent_id INT NOT NULL, filename VARCHAR(255) NOT NULL, INDEX IDX_BD98C859E5FD6250 (rent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, surface INT NOT NULL, rooms INT NOT NULL, bedrooms INT NOT NULL, floor INT NOT NULL, price INT NOT NULL, heat INT NOT NULL, city VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, sold TINYINT(1) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, lat DOUBLE PRECISION NOT NULL, lng DOUBLE PRECISION NOT NULL, created_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property_option (property_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_24F16FCC549213EC (property_id), INDEX IDX_24F16FCCA7C41D6F (option_id), PRIMARY KEY(property_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, surface INT NOT NULL, rooms INT NOT NULL, bedrooms INT NOT NULL, floor INT NOT NULL, price INT NOT NULL, heat INT NOT NULL, city VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, available TINYINT(1) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, lat DOUBLE PRECISION NOT NULL, lng DOUBLE PRECISION NOT NULL, created_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent_option_rent (rent_id INT NOT NULL, option_rent_id INT NOT NULL, INDEX IDX_37D17942E5FD6250 (rent_id), INDEX IDX_37D17942FD097525 (option_rent_id), PRIMARY KEY(rent_id, option_rent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json_array)\', email VARCHAR(255) NOT NULL, create_date DATETIME NOT NULL, is_active TINYINT(1) NOT NULL, token VARCHAR(255) NOT NULL, lastname VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, gender TINYINT(1) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, postal_code INT DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, phone INT DEFAULT NULL, mobile INT DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, biography VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE web_site_footer (id INT AUTO_INCREMENT NOT NULL, facebook VARCHAR(20) DEFAULT NULL, twitter VARCHAR(20) DEFAULT NULL, instagram VARCHAR(20) DEFAULT NULL, linkedin VARCHAR(20) DEFAULT NULL, address VARCHAR(100) DEFAULT NULL, phone INT NOT NULL, email VARCHAR(100) DEFAULT NULL, postal_code INT DEFAULT NULL, city VARCHAR(20) DEFAULT NULL, copyright LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE web_site_header (id INT AUTO_INCREMENT NOT NULL, web_title VARCHAR(50) NOT NULL, content LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE web_site_menu (id INT AUTO_INCREMENT NOT NULL, button1 VARCHAR(20) DEFAULT NULL, button2 VARCHAR(20) DEFAULT NULL, button3 VARCHAR(20) DEFAULT NULL, button4 VARCHAR(20) DEFAULT NULL, button5 VARCHAR(20) DEFAULT NULL, link1 VARCHAR(20) DEFAULT NULL, link2 VARCHAR(20) DEFAULT NULL, link3 VARCHAR(20) DEFAULT NULL, link4 VARCHAR(20) DEFAULT NULL, link5 VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE web_site_menu2 (id INT AUTO_INCREMENT NOT NULL, button1 VARCHAR(20) DEFAULT NULL, button2 VARCHAR(20) DEFAULT NULL, link1 VARCHAR(20) DEFAULT NULL, link2 VARCHAR(20) DEFAULT NULL, button3 VARCHAR(20) DEFAULT NULL, link3 VARCHAR(20) DEFAULT NULL, button4 VARCHAR(20) DEFAULT NULL, link4 VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE web_site_menu_admin (id INT AUTO_INCREMENT NOT NULL, button1 VARCHAR(40) DEFAULT NULL, button2 VARCHAR(40) DEFAULT NULL, link1 VARCHAR(40) DEFAULT NULL, link2 VARCHAR(40) DEFAULT NULL, button3 VARCHAR(40) DEFAULT NULL, link3 VARCHAR(40) DEFAULT NULL, button4 VARCHAR(40) DEFAULT NULL, link4 VARCHAR(40) DEFAULT NULL, button5 VARCHAR(40) DEFAULT NULL, button6 VARCHAR(40) DEFAULT NULL, button7 VARCHAR(40) DEFAULT NULL, link5 VARCHAR(40) DEFAULT NULL, link6 VARCHAR(40) DEFAULT NULL, link7 VARCHAR(40) DEFAULT NULL, icon1 VARCHAR(40) DEFAULT NULL, icon2 VARCHAR(40) DEFAULT NULL, icon3 VARCHAR(40) DEFAULT NULL, icon4 VARCHAR(40) DEFAULT NULL, icon5 VARCHAR(40) DEFAULT NULL, icon6 VARCHAR(40) DEFAULT NULL, icon7 VARCHAR(40) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE web_site_menu_pro (id INT AUTO_INCREMENT NOT NULL, button1 VARCHAR(40) DEFAULT NULL, button2 VARCHAR(40) DEFAULT NULL, link1 VARCHAR(40) DEFAULT NULL, link2 VARCHAR(40) DEFAULT NULL, button3 VARCHAR(40) DEFAULT NULL, link3 VARCHAR(40) DEFAULT NULL, button4 VARCHAR(40) DEFAULT NULL, link4 VARCHAR(40) DEFAULT NULL, button5 VARCHAR(40) DEFAULT NULL, link5 VARCHAR(40) DEFAULT NULL, icon1 VARCHAR(40) DEFAULT NULL, icon2 VARCHAR(40) DEFAULT NULL, icon3 VARCHAR(40) DEFAULT NULL, icon4 VARCHAR(40) DEFAULT NULL, icon5 VARCHAR(40) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE picture_rent ADD CONSTRAINT FK_BD98C859E5FD6250 FOREIGN KEY (rent_id) REFERENCES rent (id)');
        $this->addSql('ALTER TABLE property_option ADD CONSTRAINT FK_24F16FCC549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property_option ADD CONSTRAINT FK_24F16FCCA7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rent_option_rent ADD CONSTRAINT FK_37D17942E5FD6250 FOREIGN KEY (rent_id) REFERENCES rent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rent_option_rent ADD CONSTRAINT FK_37D17942FD097525 FOREIGN KEY (option_rent_id) REFERENCES `optionrent` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property_option DROP FOREIGN KEY FK_24F16FCCA7C41D6F');
        $this->addSql('ALTER TABLE rent_option_rent DROP FOREIGN KEY FK_37D17942FD097525');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89549213EC');
        $this->addSql('ALTER TABLE property_option DROP FOREIGN KEY FK_24F16FCC549213EC');
        $this->addSql('ALTER TABLE picture_rent DROP FOREIGN KEY FK_BD98C859E5FD6250');
        $this->addSql('ALTER TABLE rent_option_rent DROP FOREIGN KEY FK_37D17942E5FD6250');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FA76ED395');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE mailbox');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE `optionrent`');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE picture_rent');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE property_option');
        $this->addSql('DROP TABLE rent');
        $this->addSql('DROP TABLE rent_option_rent');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE web_site_footer');
        $this->addSql('DROP TABLE web_site_header');
        $this->addSql('DROP TABLE web_site_menu');
        $this->addSql('DROP TABLE web_site_menu2');
        $this->addSql('DROP TABLE web_site_menu_admin');
        $this->addSql('DROP TABLE web_site_menu_pro');
    }
}

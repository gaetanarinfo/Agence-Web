<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210410123838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appartement_a (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, surface INT NOT NULL, rooms INT NOT NULL, bedrooms INT NOT NULL, floor INT NOT NULL, price INT NOT NULL, heat INT NOT NULL, city VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, available TINYINT(1) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, lat DOUBLE PRECISION NOT NULL, lng DOUBLE PRECISION NOT NULL, created_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appartement_a_option_appartement_a (appartement_a_id INT NOT NULL, option_appartement_a_id INT NOT NULL, INDEX IDX_B326AF662B44A842 (appartement_a_id), INDEX IDX_B326AF6698BA88D6 (option_appartement_a_id), PRIMARY KEY(appartement_a_id, option_appartement_a_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `optionappartementa` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture_appartement_a (id INT AUTO_INCREMENT NOT NULL, appartement_a_id INT NOT NULL, filename VARCHAR(255) NOT NULL, INDEX IDX_E57D1432B44A842 (appartement_a_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appartement_a_option_appartement_a ADD CONSTRAINT FK_B326AF662B44A842 FOREIGN KEY (appartement_a_id) REFERENCES appartement_a (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appartement_a_option_appartement_a ADD CONSTRAINT FK_B326AF6698BA88D6 FOREIGN KEY (option_appartement_a_id) REFERENCES `optionappartementa` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture_appartement_a ADD CONSTRAINT FK_E57D1432B44A842 FOREIGN KEY (appartement_a_id) REFERENCES appartement_a (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartement_a_option_appartement_a DROP FOREIGN KEY FK_B326AF662B44A842');
        $this->addSql('ALTER TABLE picture_appartement_a DROP FOREIGN KEY FK_E57D1432B44A842');
        $this->addSql('ALTER TABLE appartement_a_option_appartement_a DROP FOREIGN KEY FK_B326AF6698BA88D6');
        $this->addSql('DROP TABLE appartement_a');
        $this->addSql('DROP TABLE appartement_a_option_appartement_a');
        $this->addSql('DROP TABLE `optionappartementa`');
        $this->addSql('DROP TABLE picture_appartement_a');
    }
}

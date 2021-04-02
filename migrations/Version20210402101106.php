<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402101106 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE picture_user (id INT AUTO_INCREMENT NOT NULL, rent_id INT NOT NULL, filename VARCHAR(255) NOT NULL, INDEX IDX_327353DCE5FD6250 (rent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE picture_user ADD CONSTRAINT FK_327353DCE5FD6250 FOREIGN KEY (rent_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE avatar');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, filename VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_1677722FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE picture_user');
    }
}

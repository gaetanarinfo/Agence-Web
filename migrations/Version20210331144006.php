<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331144006 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rent_option_rent (rent_id INT NOT NULL, option_rent_id INT NOT NULL, INDEX IDX_37D17942E5FD6250 (rent_id), INDEX IDX_37D17942FD097525 (option_rent_id), PRIMARY KEY(rent_id, option_rent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rent_option_rent ADD CONSTRAINT FK_37D17942E5FD6250 FOREIGN KEY (rent_id) REFERENCES rent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rent_option_rent ADD CONSTRAINT FK_37D17942FD097525 FOREIGN KEY (option_rent_id) REFERENCES `optionrent` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE rent_option_rent');
    }
}

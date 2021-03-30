<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330141820 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture ADD rent_id INT NOT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89E5FD6250 FOREIGN KEY (rent_id) REFERENCES rent (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89E5FD6250 ON picture (rent_id)');
        $this->addSql('ALTER TABLE rent DROP picture, DROP pictures, DROP picture_files, CHANGE lat lat INT NOT NULL, CHANGE lng lng INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89E5FD6250');
        $this->addSql('DROP INDEX IDX_16DB4F89E5FD6250 ON picture');
        $this->addSql('ALTER TABLE picture DROP rent_id');
        $this->addSql('ALTER TABLE rent ADD picture VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD pictures VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD picture_files VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lat lat DOUBLE PRECISION NOT NULL, CHANGE lng lng DOUBLE PRECISION NOT NULL');
    }
}

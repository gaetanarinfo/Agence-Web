<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402083848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722F549213EC');
        $this->addSql('DROP INDEX IDX_1677722F549213EC ON avatar');
        $this->addSql('ALTER TABLE avatar CHANGE property_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1677722FA76ED395 ON avatar (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FA76ED395');
        $this->addSql('DROP INDEX IDX_1677722FA76ED395 ON avatar');
        $this->addSql('ALTER TABLE avatar CHANGE user_id property_id INT NOT NULL');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722F549213EC FOREIGN KEY (property_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1677722F549213EC ON avatar (property_id)');
    }
}

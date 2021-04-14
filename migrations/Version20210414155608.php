<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210414155608 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appartement_a_option_appartement_a (appartement_a_id INT NOT NULL, option_appartement_a_id INT NOT NULL, INDEX IDX_B326AF662B44A842 (appartement_a_id), INDEX IDX_B326AF6698BA88D6 (option_appartement_a_id), PRIMARY KEY(appartement_a_id, option_appartement_a_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appartement_b_option_appartement_b (appartement_b_id INT NOT NULL, option_appartement_b_id INT NOT NULL, INDEX IDX_1357539C39F107AC (appartement_b_id), INDEX IDX_1357539C8A0F2738 (option_appartement_b_id), PRIMARY KEY(appartement_b_id, option_appartement_b_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appartement_a_option_appartement_a ADD CONSTRAINT FK_B326AF662B44A842 FOREIGN KEY (appartement_a_id) REFERENCES appartement_a (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appartement_a_option_appartement_a ADD CONSTRAINT FK_B326AF6698BA88D6 FOREIGN KEY (option_appartement_a_id) REFERENCES `optionappartementa` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appartement_b_option_appartement_b ADD CONSTRAINT FK_1357539C39F107AC FOREIGN KEY (appartement_b_id) REFERENCES appartement_b (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appartement_b_option_appartement_b ADD CONSTRAINT FK_1357539C8A0F2738 FOREIGN KEY (option_appartement_b_id) REFERENCES `optionappartementb` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE appartement_a_option_appartement_a');
        $this->addSql('DROP TABLE appartement_b_option_appartement_b');
    }
}

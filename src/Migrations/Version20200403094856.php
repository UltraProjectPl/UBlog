<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200403094856 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE session CHANGE login_date login_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE token_valid_to token_valid_to DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE session CHANGE login_date login_date DATETIME NOT NULL, CHANGE token_valid_to token_valid_to DATETIME DEFAULT NULL');
    }
}

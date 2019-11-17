<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20191117093649 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE session (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', token VARCHAR(255) DEFAULT NULL, tokens LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', remember_me TINYINT(1) NOT NULL, login_date DATETIME NOT NULL, login_dates LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', token_valid_to DATETIME DEFAULT NULL, first_login_ip VARCHAR(255) DEFAULT NULL, ips LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user DROP token');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE session');
        $this->addSql('ALTER TABLE user ADD token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

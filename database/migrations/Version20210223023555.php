<?php

declare(strict_types=1);

namespace zinobetest\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210223023555 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) DEFAULT NULL, document VARCHAR(20) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, country VARCHAR(50) DEFAULT NULL, password VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE users');

    }
}

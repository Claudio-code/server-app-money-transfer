<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210328095515 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wallets (id INT AUTO_INCREMENT NOT NULL, money_value DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users ADD wallet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9712520F3 FOREIGN KEY (wallet_id) REFERENCES wallets (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9712520F3 ON users (wallet_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9712520F3');
        $this->addSql('DROP TABLE wallets');
        $this->addSql('DROP INDEX UNIQ_1483A5E9712520F3 ON users');
        $this->addSql('ALTER TABLE users DROP wallet_id');
    }
}

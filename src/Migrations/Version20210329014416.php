<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329014416 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('INSERT INTO wallets (money_value) VALUES (54.22), (35.02), (22.22), (22.22);');

        $this->addSql('INSERT INTO users (uuid,name,email,cpf,cnh,password,roles,created_at,updated_at,wallet_id) VALUES
        ("3d7aa434-7df9-4fc5-8a4e-5657dfdc05bf","carlos","shopkeeper@gmail.com","02305232924","1412341242","$argon2i$v=19$m=65536,t=4,p=1$Z2k2M1NwYXFuSnVzb0VjbA$N/Uc2s8PHB5jtuc2JEfEGIVby60rzl8MdL+r4ialpuQ","ROLE_SHOPKEEPER","2021-03-28 10:07:33","2021-03-28 10:07:33",1),
        ("2ffde045-f009-4fa4-96f1-11b124a2fd52","carlos","user@gmail.com","37584366058","59985659579","$argon2i$v=19$m=65536,t=4,p=1$ZXh6R1lTVm1lZzJxYTQ5Ug$iwwQUNAaK3UVSE7Q+6tZfmkK+QhVs6eo9OFzd9uvRfM","ROLE_USER","2021-03-28 20:56:04","2021-03-28 20:56:04",2),
        ("f35fa5f2-a88d-4f75-8be8-29e6bbf5b36e","carla","carla@gmail.com","71507711069","73133136420","$argon2i$v=19$m=65536,t=4,p=1$L1MxTFduVmlxNVJzR2lhcw$GgkHM/BLyyILcRB6uEuZuTkcC1BpjCF4EyP1okTyDIs","ROLE_USER","2021-03-29 01:29:04","2021-03-29 01:29:04",3),
        ("989e4fc7-be3e-4fdd-b8be-319c57b68d2a","marcos","marcos@gmail.com","83605495087","93881757403","$argon2i$v=19$m=65536,t=4,p=1$TFNvZ3ZpeEt0UGlzV1IzTw$kME9/PgrJIILG1ykC+TYnioVToNGbv6QmKYEkJHZqtM","ROLE_SHOPKEEPER","2021-03-29 01:30:52","2021-03-29 01:30:52",4);');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}

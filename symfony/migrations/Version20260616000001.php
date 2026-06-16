<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260616000001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create bank_account table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE bank_account (id INT AUTO_INCREMENT NOT NULL, owner_name VARCHAR(255) NOT NULL, account_number VARCHAR(50) NOT NULL, balance NUMERIC(12, 2) NOT NULL, currency VARCHAR(3) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_BANK_ACCOUNT_NUMBER (account_number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE bank_account');
    }
}

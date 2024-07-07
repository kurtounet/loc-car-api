<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240707102552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agence CHANGE zipcode zipcode VARCHAR(10) NOT NULL, CHANGE country country VARCHAR(10) NOT NULL, CHANGE city city VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE zipcode zipcode VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agence CHANGE zipcode zipcode VARCHAR(5) NOT NULL, CHANGE country country VARCHAR(5) NOT NULL, CHANGE city city VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `user` CHANGE zipcode zipcode VARCHAR(5) DEFAULT NULL');
    }
}

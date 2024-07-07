<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240707093507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agence CHANGE phone_number phone_number VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD phone_number VARCHAR(20) DEFAULT NULL, DROP phone');
        $this->addSql('ALTER TABLE vehicl CHANGE year year VARCHAR(4) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agence CHANGE phone_number phone_number VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD phone VARCHAR(10) DEFAULT NULL, DROP phone_number');
        $this->addSql('ALTER TABLE vehicl CHANGE year year VARCHAR(255) NOT NULL');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240707082708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vehicl_agence (vehicl_id INT NOT NULL, agence_id INT NOT NULL, INDEX IDX_80450CC55C7B053A (vehicl_id), INDEX IDX_80450CC5D725330D (agence_id), PRIMARY KEY(vehicl_id, agence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicl_agence ADD CONSTRAINT FK_80450CC55C7B053A FOREIGN KEY (vehicl_id) REFERENCES vehicl (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicl_agence ADD CONSTRAINT FK_80450CC5D725330D FOREIGN KEY (agence_id) REFERENCES agence (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicl_agence DROP FOREIGN KEY FK_80450CC55C7B053A');
        $this->addSql('ALTER TABLE vehicl_agence DROP FOREIGN KEY FK_80450CC5D725330D');
        $this->addSql('DROP TABLE vehicl_agence');
    }
}

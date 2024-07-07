<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240707070806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, num_adress INT NOT NULL, zipcode VARCHAR(5) NOT NULL, country VARCHAR(5) NOT NULL, city VARCHAR(255) NOT NULL, phone_number VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, rental_id INT DEFAULT NULL, amount NUMERIC(5, 2) DEFAULT NULL, payment_date DATETIME DEFAULT NULL, payment_method VARCHAR(50) NOT NULL, INDEX IDX_6D28840DA7CF2329 (rental_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental (id INT AUTO_INCREMENT NOT NULL, vehicle_id INT DEFAULT NULL, client_id INT DEFAULT NULL, start_date DATETIME DEFAULT NULL, end_date DATETIME DEFAULT NULL, total_price NUMERIC(5, 2) DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, INDEX IDX_1619C27D545317D1 (vehicle_id), INDEX IDX_1619C27D19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phone VARCHAR(10) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, numadress VARCHAR(5) DEFAULT NULL, zipcode VARCHAR(5) DEFAULT NULL, city VARCHAR(50) DEFAULT NULL, country VARCHAR(10) DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicl (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, year VARCHAR(255) NOT NULL, licenseplate VARCHAR(10) NOT NULL, mileage INT NOT NULL, fuel_type VARCHAR(255) NOT NULL, status VARCHAR(50) NOT NULL, price_per_day NUMERIC(5, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DA7CF2329 FOREIGN KEY (rental_id) REFERENCES rental (id)');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicl (id)');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D19EB6921 FOREIGN KEY (client_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DA7CF2329');
        $this->addSql('ALTER TABLE rental DROP FOREIGN KEY FK_1619C27D545317D1');
        $this->addSql('ALTER TABLE rental DROP FOREIGN KEY FK_1619C27D19EB6921');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE rental');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE vehicl');
    }
}

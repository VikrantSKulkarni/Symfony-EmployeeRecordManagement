<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230704055517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employees (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, email VARCHAR(80) NOT NULL, date_of_birth DATE NOT NULL, address VARCHAR(100) NOT NULL, mobile VARCHAR(60) NOT NULL, education VARCHAR(60) NOT NULL, department VARCHAR(60) NOT NULL, manager_name VARCHAR(60) DEFAULT NULL, joining_date DATE NOT NULL, profile_pic VARCHAR(60) DEFAULT NULL, resume VARCHAR(60) DEFAULT NULL, gender VARCHAR(30) NOT NULL, created_at DATETIME NOT NULL, update_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE employees');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230822040947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, supplier_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, quantity VARCHAR(255) NOT NULL, INDEX IDX_CBE5A3312ADD6D8C (supplier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE borrow_book (id INT AUTO_INCREMENT NOT NULL, member_id INT DEFAULT NULL, book_id INT DEFAULT NULL, borrow_date DATE NOT NULL, return_date DATE NOT NULL, INDEX IDX_48C899147597D3FE (member_id), INDEX IDX_48C8991416A2B381 (book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3312ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE borrow_book ADD CONSTRAINT FK_48C899147597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE borrow_book ADD CONSTRAINT FK_48C8991416A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3312ADD6D8C');
        $this->addSql('ALTER TABLE borrow_book DROP FOREIGN KEY FK_48C899147597D3FE');
        $this->addSql('ALTER TABLE borrow_book DROP FOREIGN KEY FK_48C8991416A2B381');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE borrow_book');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE supplier');
    }
}

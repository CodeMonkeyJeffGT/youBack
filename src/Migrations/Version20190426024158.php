<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190426024158 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE like_page (id INT AUTO_INCREMENT NOT NULL, u_id INT NOT NULL, p_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, column_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE like_comment (id INT AUTO_INCREMENT NOT NULL, u_id INT NOT NULL, c_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE follow_column (id INT AUTO_INCREMENT NOT NULL, u_id INT NOT NULL, c_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_collect (id INT AUTO_INCREMENT NOT NULL, u_id INT NOT NULL, f_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE follow_user (id INT AUTO_INCREMENT NOT NULL, u_id INT NOT NULL, f_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, account VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, sex VARCHAR(255) NOT NULL, headpic VARCHAR(255) NOT NULL, sign VARCHAR(255) NOT NULL, created DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, column_id INT NOT NULL, classificatoin_id INT NOT NULL, content LONGTEXT NOT NULL, u_id INT NOT NULL, created DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_comment (id INT AUTO_INCREMENT NOT NULL, content VARCHAR(255) NOT NULL, column_id INT NOT NULL, f_id INT NOT NULL, u_id INT NOT NULL, created DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `column` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, description VARCHAR(255) NOT NULL, type INT NOT NULL, school_id INT NOT NULL, created DATETIME NOT NULL, UNIQUE INDEX UNIQ_7D53877E5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, type INT NOT NULL, r_id INT NOT NULL, content VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE column_classification (id INT AUTO_INCREMENT NOT NULL, column_id INT NOT NULL, name VARCHAR(255) NOT NULL, f_id INT NOT NULL, removable TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE like_page');
        $this->addSql('DROP TABLE school');
        $this->addSql('DROP TABLE like_comment');
        $this->addSql('DROP TABLE follow_column');
        $this->addSql('DROP TABLE page_collect');
        $this->addSql('DROP TABLE follow_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE page_comment');
        $this->addSql('DROP TABLE `column`');
        $this->addSql('DROP TABLE report');
        $this->addSql('DROP TABLE column_classification');
    }
}

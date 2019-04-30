<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190429122942 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE like_page (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, page_id INT NOT NULL, INDEX IDX_CD7F6A5EA76ED395 (user_id), INDEX IDX_CD7F6A5EC4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, class_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE like_comment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, comment_id INT NOT NULL, INDEX IDX_C7F9184FA76ED395 (user_id), INDEX IDX_C7F9184FF8697D13 (comment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE follow_column (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, acolumn_id INT NOT NULL, INDEX IDX_56F23906A76ED395 (user_id), INDEX IDX_56F2390685289D43 (acolumn_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_collect (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, page_id INT NOT NULL, INDEX IDX_5E668961A76ED395 (user_id), INDEX IDX_5E668961C4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE follow_user (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, follow_id INT NOT NULL, INDEX IDX_B3542514A76ED395 (user_id), INDEX IDX_B35425148711D3BC (follow_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, school_id INT NOT NULL, account VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, sex VARCHAR(255) NOT NULL, headpic VARCHAR(255) NOT NULL, sign VARCHAR(255) NOT NULL, created DATETIME NOT NULL, last_password VARCHAR(255) NOT NULL, INDEX IDX_8D93D649C32A47EE (school_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE columns (id INT AUTO_INCREMENT NOT NULL, school_id INT DEFAULT NULL, owner_id INT NOT NULL, name VARCHAR(20) NOT NULL, description VARCHAR(255) NOT NULL, type INT NOT NULL, created DATETIME NOT NULL, UNIQUE INDEX UNIQ_ACCEC0B75E237E06 (name), INDEX IDX_ACCEC0B7C32A47EE (school_id), INDEX IDX_ACCEC0B77E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_user (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, menu_id INT NOT NULL, loc INT NOT NULL, INDEX IDX_45DC2607A76ED395 (user_id), INDEX IDX_45DC2607CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, acolumn_id INT NOT NULL, classification_id INT NOT NULL, name VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created DATETIME NOT NULL, INDEX IDX_140AB620A76ED395 (user_id), INDEX IDX_140AB62085289D43 (acolumn_id), INDEX IDX_140AB6202A86559F (classification_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_comment (id INT AUTO_INCREMENT NOT NULL, page_id INT NOT NULL, user_id INT NOT NULL, father_id INT DEFAULT NULL, back_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, created DATETIME NOT NULL, INDEX IDX_6E14B9F9C4663E4 (page_id), INDEX IDX_6E14B9F9A76ED395 (user_id), INDEX IDX_6E14B9F92055B9A2 (father_id), INDEX IDX_6E14B9F9E9583FF0 (back_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, sender_id INT NOT NULL, type INT NOT NULL, content VARCHAR(255) NOT NULL, created DATETIME NOT NULL, INDEX IDX_B6BD307FA76ED395 (user_id), INDEX IDX_B6BD307FF624B39D (sender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, type INT NOT NULL, content VARCHAR(255) NOT NULL, created DATETIME NOT NULL, r_id INT NOT NULL, INDEX IDX_C42F7784A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE column_classification (id INT AUTO_INCREMENT NOT NULL, column_owned_id INT NOT NULL, name VARCHAR(255) NOT NULL, removable TINYINT(1) NOT NULL, INDEX IDX_9A26D3E0E190556B (column_owned_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE like_page ADD CONSTRAINT FK_CD7F6A5EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE like_page ADD CONSTRAINT FK_CD7F6A5EC4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE like_comment ADD CONSTRAINT FK_C7F9184FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE like_comment ADD CONSTRAINT FK_C7F9184FF8697D13 FOREIGN KEY (comment_id) REFERENCES page_comment (id)');
        $this->addSql('ALTER TABLE follow_column ADD CONSTRAINT FK_56F23906A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE follow_column ADD CONSTRAINT FK_56F2390685289D43 FOREIGN KEY (acolumn_id) REFERENCES columns (id)');
        $this->addSql('ALTER TABLE page_collect ADD CONSTRAINT FK_5E668961A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE page_collect ADD CONSTRAINT FK_5E668961C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE follow_user ADD CONSTRAINT FK_B3542514A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE follow_user ADD CONSTRAINT FK_B35425148711D3BC FOREIGN KEY (follow_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE columns ADD CONSTRAINT FK_ACCEC0B7C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE columns ADD CONSTRAINT FK_ACCEC0B77E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE menu_user ADD CONSTRAINT FK_45DC2607A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE menu_user ADD CONSTRAINT FK_45DC2607CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB62085289D43 FOREIGN KEY (acolumn_id) REFERENCES columns (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6202A86559F FOREIGN KEY (classification_id) REFERENCES column_classification (id)');
        $this->addSql('ALTER TABLE page_comment ADD CONSTRAINT FK_6E14B9F9C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE page_comment ADD CONSTRAINT FK_6E14B9F9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE page_comment ADD CONSTRAINT FK_6E14B9F92055B9A2 FOREIGN KEY (father_id) REFERENCES page_comment (id)');
        $this->addSql('ALTER TABLE page_comment ADD CONSTRAINT FK_6E14B9F9E9583FF0 FOREIGN KEY (back_id) REFERENCES page_comment (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE column_classification ADD CONSTRAINT FK_9A26D3E0E190556B FOREIGN KEY (column_owned_id) REFERENCES columns (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C32A47EE');
        $this->addSql('ALTER TABLE columns DROP FOREIGN KEY FK_ACCEC0B7C32A47EE');
        $this->addSql('ALTER TABLE like_page DROP FOREIGN KEY FK_CD7F6A5EA76ED395');
        $this->addSql('ALTER TABLE like_comment DROP FOREIGN KEY FK_C7F9184FA76ED395');
        $this->addSql('ALTER TABLE follow_column DROP FOREIGN KEY FK_56F23906A76ED395');
        $this->addSql('ALTER TABLE page_collect DROP FOREIGN KEY FK_5E668961A76ED395');
        $this->addSql('ALTER TABLE follow_user DROP FOREIGN KEY FK_B3542514A76ED395');
        $this->addSql('ALTER TABLE follow_user DROP FOREIGN KEY FK_B35425148711D3BC');
        $this->addSql('ALTER TABLE columns DROP FOREIGN KEY FK_ACCEC0B77E3C61F9');
        $this->addSql('ALTER TABLE menu_user DROP FOREIGN KEY FK_45DC2607A76ED395');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620A76ED395');
        $this->addSql('ALTER TABLE page_comment DROP FOREIGN KEY FK_6E14B9F9A76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF624B39D');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784A76ED395');
        $this->addSql('ALTER TABLE follow_column DROP FOREIGN KEY FK_56F2390685289D43');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB62085289D43');
        $this->addSql('ALTER TABLE column_classification DROP FOREIGN KEY FK_9A26D3E0E190556B');
        $this->addSql('ALTER TABLE menu_user DROP FOREIGN KEY FK_45DC2607CCD7E912');
        $this->addSql('ALTER TABLE like_page DROP FOREIGN KEY FK_CD7F6A5EC4663E4');
        $this->addSql('ALTER TABLE page_collect DROP FOREIGN KEY FK_5E668961C4663E4');
        $this->addSql('ALTER TABLE page_comment DROP FOREIGN KEY FK_6E14B9F9C4663E4');
        $this->addSql('ALTER TABLE like_comment DROP FOREIGN KEY FK_C7F9184FF8697D13');
        $this->addSql('ALTER TABLE page_comment DROP FOREIGN KEY FK_6E14B9F92055B9A2');
        $this->addSql('ALTER TABLE page_comment DROP FOREIGN KEY FK_6E14B9F9E9583FF0');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6202A86559F');
        $this->addSql('DROP TABLE like_page');
        $this->addSql('DROP TABLE school');
        $this->addSql('DROP TABLE like_comment');
        $this->addSql('DROP TABLE follow_column');
        $this->addSql('DROP TABLE page_collect');
        $this->addSql('DROP TABLE follow_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE columns');
        $this->addSql('DROP TABLE menu_user');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE page_comment');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE report');
        $this->addSql('DROP TABLE column_classification');
    }
}

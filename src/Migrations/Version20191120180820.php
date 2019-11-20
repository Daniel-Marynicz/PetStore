<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191120180820 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pet_store (
          id INT AUTO_INCREMENT NOT NULL, 
          name VARCHAR(255) NOT NULL, 
          surname VARCHAR(255) NOT NULL, 
          UNIQUE INDEX UNIQ_522B98D45E237E06E7769B0F (name, surname), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pet (
          id INT AUTO_INCREMENT NOT NULL, 
          pet_store_id INT DEFAULT NULL, 
          name VARCHAR(255) NOT NULL, 
          species VARCHAR(255) NOT NULL, 
          INDEX IDX_E4529B85F9E5A1DC (pet_store_id), 
          UNIQUE INDEX UNIQ_E4529B85F9E5A1DC5E237E06 (pet_store_id, name), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE 
          pet 
        ADD 
          CONSTRAINT FK_E4529B85F9E5A1DC FOREIGN KEY (pet_store_id) REFERENCES pet_store (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pet DROP FOREIGN KEY FK_E4529B85F9E5A1DC');
        $this->addSql('DROP TABLE pet_store');
        $this->addSql('DROP TABLE pet');
    }
}

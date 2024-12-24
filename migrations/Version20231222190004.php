<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231222190004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pratique (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, sport_id INT NOT NULL, niveau VARCHAR(255) NOT NULL, INDEX IDX_1F2B781A76ED395 (user_id), INDEX IDX_1F2B781AC78BCF8 (sport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pratique ADD CONSTRAINT FK_1F2B781A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pratique ADD CONSTRAINT FK_1F2B781AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pratique DROP FOREIGN KEY FK_1F2B781A76ED395');
        $this->addSql('ALTER TABLE pratique DROP FOREIGN KEY FK_1F2B781AC78BCF8');
        $this->addSql('DROP TABLE pratique');
    }
}

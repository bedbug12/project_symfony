<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230118113615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE burger ADD panier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0DF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE INDEX IDX_EFE35A0DF77D927C ON burger (panier_id)');
        $this->addSql('ALTER TABLE menu ADD panier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE INDEX IDX_7D053A93F77D927C ON menu (panier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0DF77D927C');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93F77D927C');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP INDEX IDX_EFE35A0DF77D927C ON burger');
        $this->addSql('ALTER TABLE burger DROP panier_id');
        $this->addSql('DROP INDEX IDX_7D053A93F77D927C ON menu');
        $this->addSql('ALTER TABLE menu DROP panier_id');
    }
}

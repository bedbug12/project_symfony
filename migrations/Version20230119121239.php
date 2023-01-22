<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119121239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE burger_commande (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, burger_id INT NOT NULL, qte_burger INT NOT NULL, INDEX IDX_A0D9FE9982EA2E54 (commande_id), INDEX IDX_A0D9FE9917CE5090 (burger_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_commande (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, menu_id INT NOT NULL, qte_menu INT NOT NULL, INDEX IDX_42BBE3EB82EA2E54 (commande_id), INDEX IDX_42BBE3EBCCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE burger_commande ADD CONSTRAINT FK_A0D9FE9982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE burger_commande ADD CONSTRAINT FK_A0D9FE9917CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
        $this->addSql('ALTER TABLE menu_commande ADD CONSTRAINT FK_42BBE3EB82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE menu_commande ADD CONSTRAINT FK_42BBE3EBCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0D82EA2E54');
        $this->addSql('DROP INDEX IDX_EFE35A0D82EA2E54 ON burger');
        $this->addSql('ALTER TABLE burger DROP commande_id');
        $this->addSql('ALTER TABLE commande DROP qte_menu, DROP qte_burger');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9382EA2E54');
        $this->addSql('DROP INDEX IDX_7D053A9382EA2E54 ON menu');
        $this->addSql('ALTER TABLE menu DROP commande_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE burger_commande DROP FOREIGN KEY FK_A0D9FE9982EA2E54');
        $this->addSql('ALTER TABLE burger_commande DROP FOREIGN KEY FK_A0D9FE9917CE5090');
        $this->addSql('ALTER TABLE menu_commande DROP FOREIGN KEY FK_42BBE3EB82EA2E54');
        $this->addSql('ALTER TABLE menu_commande DROP FOREIGN KEY FK_42BBE3EBCCD7E912');
        $this->addSql('DROP TABLE burger_commande');
        $this->addSql('DROP TABLE menu_commande');
        $this->addSql('ALTER TABLE burger ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_EFE35A0D82EA2E54 ON burger (commande_id)');
        $this->addSql('ALTER TABLE commande ADD qte_menu INT DEFAULT NULL, ADD qte_burger INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_7D053A9382EA2E54 ON menu (commande_id)');
    }
}

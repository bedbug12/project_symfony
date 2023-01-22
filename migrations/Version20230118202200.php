<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230118202200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DD8D003BB');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93D8D003BB');
        $this->addSql('ALTER TABLE details DROP FOREIGN KEY FK_72260B8A17CE5090');
        $this->addSql('ALTER TABLE details DROP FOREIGN KEY FK_72260B8A82EA2E54');
        $this->addSql('DROP TABLE detail');
        $this->addSql('DROP TABLE details');
        $this->addSql('ALTER TABLE burger ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_EFE35A0D82EA2E54 ON burger (commande_id)');
        $this->addSql('DROP INDEX IDX_6EEAA67DD8D003BB ON commande');
        $this->addSql('ALTER TABLE commande ADD qte_burger INT DEFAULT NULL, CHANGE detail_id qte_menu INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_7D053A93D8D003BB ON menu');
        $this->addSql('ALTER TABLE menu ADD commande_id INT DEFAULT NULL, DROP detail_id');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_7D053A9382EA2E54 ON menu (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detail (id INT AUTO_INCREMENT NOT NULL, qte_menu INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE details (id INT AUTO_INCREMENT NOT NULL, burger_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, qte_burger INT NOT NULL, INDEX IDX_72260B8A17CE5090 (burger_id), INDEX IDX_72260B8A82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8A17CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8A82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0D82EA2E54');
        $this->addSql('DROP INDEX IDX_EFE35A0D82EA2E54 ON burger');
        $this->addSql('ALTER TABLE burger DROP commande_id');
        $this->addSql('ALTER TABLE commande ADD detail_id INT DEFAULT NULL, DROP qte_menu, DROP qte_burger');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DD8D003BB FOREIGN KEY (detail_id) REFERENCES detail (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DD8D003BB ON commande (detail_id)');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9382EA2E54');
        $this->addSql('DROP INDEX IDX_7D053A9382EA2E54 ON menu');
        $this->addSql('ALTER TABLE menu ADD detail_id INT NOT NULL, DROP commande_id');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93D8D003BB FOREIGN KEY (detail_id) REFERENCES detail (id)');
        $this->addSql('CREATE INDEX IDX_7D053A93D8D003BB ON menu (detail_id)');
    }
}

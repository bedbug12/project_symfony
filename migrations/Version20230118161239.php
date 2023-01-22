<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230118161239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panier ADD burger_id INT DEFAULT NULL, ADD menu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF217CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_24CC0DF217CE5090 ON panier (burger_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_24CC0DF2CCD7E912 ON panier (menu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF217CE5090');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2CCD7E912');
        $this->addSql('DROP INDEX UNIQ_24CC0DF217CE5090 ON panier');
        $this->addSql('DROP INDEX UNIQ_24CC0DF2CCD7E912 ON panier');
        $this->addSql('ALTER TABLE panier DROP burger_id, DROP menu_id');
    }
}

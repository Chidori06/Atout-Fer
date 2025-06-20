<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319152414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD status_order_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981045CAE0 FOREIGN KEY (status_order_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_F52993981045CAE0 ON `order` (status_order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981045CAE0');
        $this->addSql('DROP INDEX IDX_F52993981045CAE0 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP status_order_id');
    }
}

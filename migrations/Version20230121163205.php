<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230121163205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE good ADD currency_id INT NOT NULL');
        $this->addSql('ALTER TABLE good ADD CONSTRAINT FK_6C844E9238248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_6C844E9238248176 ON good (currency_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE good DROP FOREIGN KEY FK_6C844E9238248176');
        $this->addSql('DROP INDEX IDX_6C844E9238248176 ON good');
        $this->addSql('ALTER TABLE good DROP currency_id');
    }
}

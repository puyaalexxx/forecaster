<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250809133349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE forecast (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, location_id INTEGER NOT NULL, tempaerature_celsius INTEGER NOT NULL, humidity INTEGER NOT NULL, wind_speed INTEGER NOT NULL, pressure INTEGER NOT NULL, CONSTRAINT FK_2A9C784464D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2A9C784464D218E ON forecast (location_id)');
        $this->addSql('ALTER TABLE location ADD COLUMN name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE location ADD COLUMN longitute NUMERIC(7, 0) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE forecast');
        $this->addSql('CREATE TEMPORARY TABLE __temp__location AS SELECT id, country_code, latitude FROM location');
        $this->addSql('DROP TABLE location');
        $this->addSql('CREATE TABLE location (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_code VARCHAR(4) NOT NULL, latitude NUMERIC(7, 0) NOT NULL)');
        $this->addSql('INSERT INTO location (id, country_code, latitude) SELECT id, country_code, latitude FROM __temp__location');
        $this->addSql('DROP TABLE __temp__location');
    }
}

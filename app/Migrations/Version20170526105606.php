<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170526105606 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Incident (id INT AUTO_INCREMENT NOT NULL, incidentId VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, service VARCHAR(255) NOT NULL, serviceStatus VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, createdAt DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incident_updates (incident_id INT NOT NULL, update_id INT NOT NULL, INDEX IDX_E28209ED59E53FB9 (incident_id), INDEX IDX_E28209EDD596EAB1 (update_id), PRIMARY KEY(incident_id, update_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `Update` (id INT AUTO_INCREMENT NOT NULL, updateId VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, severity VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, updateAt DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE incident_updates ADD CONSTRAINT FK_E28209ED59E53FB9 FOREIGN KEY (incident_id) REFERENCES Incident (id)');
        $this->addSql('ALTER TABLE incident_updates ADD CONSTRAINT FK_E28209EDD596EAB1 FOREIGN KEY (update_id) REFERENCES `Update` (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE incident_updates DROP FOREIGN KEY FK_E28209ED59E53FB9');
        $this->addSql('ALTER TABLE incident_updates DROP FOREIGN KEY FK_E28209EDD596EAB1');
        $this->addSql('DROP TABLE Incident');
        $this->addSql('DROP TABLE incident_updates');
        $this->addSql('DROP TABLE `Update`');
    }
}

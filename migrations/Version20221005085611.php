<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005085611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, rue VARCHAR(30) NOT NULL, ville VARCHAR(30) NOT NULL, codepostal INT NOT NULL, secteur VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_C7440455E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur_activites (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, parent_id INT DEFAULT NULL, intitule VARCHAR(40) NOT NULL, INDEX IDX_CC5FC45AA76ED395 (user_id), INDEX IDX_CC5FC45A727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE secteur_activites ADD CONSTRAINT FK_CC5FC45AA76ED395 FOREIGN KEY (user_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE secteur_activites ADD CONSTRAINT FK_CC5FC45A727ACA70 FOREIGN KEY (parent_id) REFERENCES secteur_activites (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE secteur_activites DROP FOREIGN KEY FK_CC5FC45AA76ED395');
        $this->addSql('ALTER TABLE secteur_activites DROP FOREIGN KEY FK_CC5FC45A727ACA70');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE secteur_activites');
    }
}

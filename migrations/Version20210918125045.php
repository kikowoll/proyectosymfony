<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210918125045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contratos (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, empresa_id INT DEFAULT NULL, salida VARCHAR(255) DEFAULT NULL, llegada VARCHAR(255) DEFAULT NULL, fecha VARCHAR(100) DEFAULT NULL, precio VARCHAR(100) DEFAULT NULL,  INDEX  (usuario_id),  INDEX  (empresa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE empresas (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) DEFAULT NULL, precio_trailer VARCHAR(100) DEFAULT NULL, precio_camion VARCHAR(100) DEFAULT NULL, precio_furgon VARCHAR(100) DEFAULT NULL, precio_coche VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contratos ADD CONSTRAINT FK_B90FD71CDB38439E FOREIGN KEY (usuario_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contratos ADD CONSTRAINT FK_B90FD71C521E1991 FOREIGN KEY (empresa_id) REFERENCES empresas (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contratos DROP FOREIGN KEY FK_B90FD71C521E1991');
        $this->addSql('DROP TABLE contratos');
        $this->addSql('DROP TABLE empresas');
    }
}

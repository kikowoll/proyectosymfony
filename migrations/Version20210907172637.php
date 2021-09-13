<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210907172637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clientes (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, contratos_id INT DEFAULT NULL, fecha VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_50FE07D7DB38439E (usuario_id), UNIQUE INDEX UNIQ_50FE07D72DBBD1D4 (contratos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clientes_empresas (clientes_id INT NOT NULL, empresas_id INT NOT NULL, INDEX IDX_1C71605FFBC3AF09 (clientes_id), INDEX IDX_1C71605F602B00EE (empresas_id), PRIMARY KEY(clientes_id, empresas_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contratos (id INT AUTO_INCREMENT NOT NULL, salida VARCHAR(255) DEFAULT NULL, llegada VARCHAR(255) DEFAULT NULL, precio VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clientes ADD CONSTRAINT FK_50FE07D7DB38439E FOREIGN KEY (usuario_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE clientes ADD CONSTRAINT FK_50FE07D72DBBD1D4 FOREIGN KEY (contratos_id) REFERENCES contratos (id)');
        $this->addSql('ALTER TABLE clientes_empresas ADD CONSTRAINT FK_1C71605FFBC3AF09 FOREIGN KEY (clientes_id) REFERENCES clientes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clientes_empresas ADD CONSTRAINT FK_1C71605F602B00EE FOREIGN KEY (empresas_id) REFERENCES empresas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD telefono VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clientes_empresas DROP FOREIGN KEY FK_1C71605FFBC3AF09');
        $this->addSql('ALTER TABLE clientes DROP FOREIGN KEY FK_50FE07D72DBBD1D4');
        $this->addSql('DROP TABLE clientes');
        $this->addSql('DROP TABLE clientes_empresas');
        $this->addSql('DROP TABLE contratos');
        $this->addSql('ALTER TABLE user DROP telefono');
    }
}

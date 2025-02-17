<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250217134404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wine_type (wine_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_2906785C28A2BD76 (wine_id), INDEX IDX_2906785CC54C8C93 (type_id), PRIMARY KEY(wine_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wine_type ADD CONSTRAINT FK_2906785C28A2BD76 FOREIGN KEY (wine_id) REFERENCES wine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wine_type ADD CONSTRAINT FK_2906785CC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_wine DROP FOREIGN KEY FK_8103A16028A2BD76');
        $this->addSql('ALTER TABLE type_wine DROP FOREIGN KEY FK_8103A160C54C8C93');
        $this->addSql('DROP TABLE type_wine');
        $this->addSql('ALTER TABLE wine ADD CONSTRAINT FK_560C646898260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE INDEX IDX_560C646898260155 ON wine (region_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_wine (type_id INT NOT NULL, wine_id INT NOT NULL, INDEX IDX_8103A16028A2BD76 (wine_id), INDEX IDX_8103A160C54C8C93 (type_id), PRIMARY KEY(type_id, wine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE type_wine ADD CONSTRAINT FK_8103A16028A2BD76 FOREIGN KEY (wine_id) REFERENCES wine (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_wine ADD CONSTRAINT FK_8103A160C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wine_type DROP FOREIGN KEY FK_2906785C28A2BD76');
        $this->addSql('ALTER TABLE wine_type DROP FOREIGN KEY FK_2906785CC54C8C93');
        $this->addSql('DROP TABLE wine_type');
        $this->addSql('ALTER TABLE wine DROP FOREIGN KEY FK_560C646898260155');
        $this->addSql('DROP INDEX IDX_560C646898260155 ON wine');
    }
}

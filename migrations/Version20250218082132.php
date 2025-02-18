<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250218082132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_wine DROP FOREIGN KEY FK_8103A16028A2BD76');
        $this->addSql('ALTER TABLE type_wine DROP FOREIGN KEY FK_8103A160C54C8C93');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE type_wine');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_wine (type_id INT NOT NULL, wine_id INT NOT NULL, INDEX IDX_8103A16028A2BD76 (wine_id), INDEX IDX_8103A160C54C8C93 (type_id), PRIMARY KEY(type_id, wine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE type_wine ADD CONSTRAINT FK_8103A16028A2BD76 FOREIGN KEY (wine_id) REFERENCES wine (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_wine ADD CONSTRAINT FK_8103A160C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}

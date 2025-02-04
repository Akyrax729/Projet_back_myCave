<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204145556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wine_cave (wine_id INT NOT NULL, cave_id INT NOT NULL, INDEX IDX_A0A7423428A2BD76 (wine_id), INDEX IDX_A0A742347F05B85 (cave_id), PRIMARY KEY(wine_id, cave_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wine_cave ADD CONSTRAINT FK_A0A7423428A2BD76 FOREIGN KEY (wine_id) REFERENCES wine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wine_cave ADD CONSTRAINT FK_A0A742347F05B85 FOREIGN KEY (cave_id) REFERENCES cave (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cave DROP FOREIGN KEY FK_57F6D419D86650F');
        $this->addSql('DROP INDEX UNIQ_57F6D419D86650F ON cave');
        $this->addSql('ALTER TABLE cave CHANGE user_id_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cave ADD CONSTRAINT FK_57F6D41A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57F6D41A76ED395 ON cave (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wine_cave DROP FOREIGN KEY FK_A0A7423428A2BD76');
        $this->addSql('ALTER TABLE wine_cave DROP FOREIGN KEY FK_A0A742347F05B85');
        $this->addSql('DROP TABLE wine_cave');
        $this->addSql('ALTER TABLE cave DROP FOREIGN KEY FK_57F6D41A76ED395');
        $this->addSql('DROP INDEX UNIQ_57F6D41A76ED395 ON cave');
        $this->addSql('ALTER TABLE cave CHANGE user_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cave ADD CONSTRAINT FK_57F6D419D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57F6D419D86650F ON cave (user_id_id)');
    }
}

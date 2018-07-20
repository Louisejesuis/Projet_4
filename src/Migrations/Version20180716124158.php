<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180716124158 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, gender VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person ADD gender_id INT DEFAULT NULL, ADD quality LONGTEXT NOT NULL, ADD defect LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('CREATE INDEX IDX_34DCD176708A0E0 ON person (gender_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176708A0E0');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP INDEX IDX_34DCD176708A0E0 ON person');
        $this->addSql('ALTER TABLE person DROP gender_id, DROP quality, DROP defect');
    }
}

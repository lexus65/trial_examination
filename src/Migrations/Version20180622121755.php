<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180622121755 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE league (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, strip VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE football_team_football_league (football_team_id INT NOT NULL, football_league_id INT NOT NULL, INDEX IDX_220AEF692C60CF1E (football_team_id), INDEX IDX_220AEF693FB9EAAD (football_league_id), PRIMARY KEY(football_team_id, football_league_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE football_team_football_league ADD CONSTRAINT FK_220AEF692C60CF1E FOREIGN KEY (football_team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE football_team_football_league ADD CONSTRAINT FK_220AEF693FB9EAAD FOREIGN KEY (football_league_id) REFERENCES league (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE football_team_football_league DROP FOREIGN KEY FK_220AEF693FB9EAAD');
        $this->addSql('ALTER TABLE football_team_football_league DROP FOREIGN KEY FK_220AEF692C60CF1E');
        $this->addSql('DROP TABLE league');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE football_team_football_league');
        $this->addSql('DROP TABLE refresh_tokens');
    }
}

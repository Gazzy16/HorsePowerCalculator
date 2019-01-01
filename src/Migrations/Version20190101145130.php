<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190101145130 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE engine_stock (id INT AUTO_INCREMENT NOT NULL, manufacturer VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, production VARCHAR(255) NOT NULL, block_alloy VARCHAR(255) NOT NULL, configuration VARCHAR(255) NOT NULL, vavlvetrain VARCHAR(255) NOT NULL, displacement VARCHAR(255) NOT NULL, hp INT NOT NULL, max_hp_at_rpm INT NOT NULL, torque INT NOT NULL, max_torque_at_rpm INT NOT NULL, redline INT NOT NULL, lifespan INT NOT NULL, max_hp_stock INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE engine_stock');
    }
}

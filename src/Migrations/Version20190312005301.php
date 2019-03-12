<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190312005301 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE engine_stock (id INT AUTO_INCREMENT NOT NULL, userstock_id INT DEFAULT NULL, manufacturer VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, block_alloy ENUM(\'cast iron\', \'aluminium alloy\'), configuration ENUM(\'V-shaped\', \'W-shaped\', \'Inline\'), number_of_cylinders INT NOT NULL, valves_per_cylinder ENUM(\'3\', \'4\', \'5\'), displacement INT NOT NULL, piston_stroke INT NOT NULL, cylinder_bore INT NOT NULL, hp INT NOT NULL, torque INT NOT NULL, redline INT NOT NULL, max_hp_stock INT NOT NULL, INDEX IDX_665E822B21889E67 (userstock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE engine_tuned (id INT AUTO_INCREMENT NOT NULL, usertuned_id INT DEFAULT NULL, stock_id INT DEFAULT NULL, manufacturer VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, block_alloy ENUM(\'cast iron\', \'aluminium alloy\'), configuration ENUM(\'V-shaped\', \'W-shaped\', \'Inline\'), piston_stroke INT NOT NULL, cylinder_bore INT NOT NULL, number_of_cylinders INT NOT NULL, valves_per_cylinder ENUM(\'3\', \'4\', \'5\'), displacement INT NOT NULL, hp INT NOT NULL, torque INT NOT NULL, redline INT NOT NULL, INDEX IDX_ABE5E97E9145AA99 (usertuned_id), INDEX IDX_ABE5E97EDCD6110 (stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE upgrade (id INT AUTO_INCREMENT NOT NULL, stockupgrade_id INT DEFAULT NULL, forced_induction ENUM(\'none\', \'turbo\', \'supercharger\'), intake ENUM(\'stock\', \'street\', \'sport\', \'deleted\'), ecu ENUM(\'stock\', \'street\', \'sport\', \'type r\'), pistons ENUM(\'stock\', \'street\', \'sport\', \'type r\'), intercooler ENUM(\'stock\', \'street\', \'sport\', \'type r\'), exhaust ENUM(\'stock\', \'street\', \'sport\', \'type r\'), INDEX IDX_B766741A4D73DC4B (stockupgrade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, isadmin TINYINT(1) DEFAULT NULL, isdeleted TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE engine_stock ADD CONSTRAINT FK_665E822B21889E67 FOREIGN KEY (userstock_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE engine_tuned ADD CONSTRAINT FK_ABE5E97E9145AA99 FOREIGN KEY (usertuned_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE engine_tuned ADD CONSTRAINT FK_ABE5E97EDCD6110 FOREIGN KEY (stock_id) REFERENCES engine_stock (id)');
        $this->addSql('ALTER TABLE upgrade ADD CONSTRAINT FK_B766741A4D73DC4B FOREIGN KEY (stockupgrade_id) REFERENCES engine_stock (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE engine_tuned DROP FOREIGN KEY FK_ABE5E97EDCD6110');
        $this->addSql('ALTER TABLE upgrade DROP FOREIGN KEY FK_B766741A4D73DC4B');
        $this->addSql('ALTER TABLE engine_stock DROP FOREIGN KEY FK_665E822B21889E67');
        $this->addSql('ALTER TABLE engine_tuned DROP FOREIGN KEY FK_ABE5E97E9145AA99');
        $this->addSql('DROP TABLE engine_stock');
        $this->addSql('DROP TABLE engine_tuned');
        $this->addSql('DROP TABLE upgrade');
        $this->addSql('DROP TABLE user');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251017063504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2 ON product');
        $this->addSql('ALTER TABLE product DROP category_id, DROP image, CHANGE name name VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE price price NUMERIC(10, 2) NOT NULL, CHANGE quantity quantity INT NOT NULL');
        $this->addSql('ALTER TABLE stock DROP INDEX UNIQ_4B3656604584665A, ADD INDEX IDX_4B3656604584665A (product_id)');
        $this->addSql('ALTER TABLE stock CHANGE last_updated date_added DATETIME NOT NULL, CHANGE image location VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP INDEX IDX_4B3656604584665A, ADD UNIQUE INDEX UNIQ_4B3656604584665A (product_id)');
        $this->addSql('ALTER TABLE stock CHANGE location image VARCHAR(255) DEFAULT NULL, CHANGE date_added last_updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE product ADD category_id INT DEFAULT NULL, ADD image VARCHAR(255) NOT NULL, CHANGE name name VARCHAR(100) NOT NULL, CHANGE price price DOUBLE PRECISION NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE quantity quantity DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
    }
}

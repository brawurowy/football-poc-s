<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180703093127 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE team ADD COLUMN deleted_at DATETIME DEFAULT NULL;');

    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE team DROP COLUMN deleted_at;');
    }
}

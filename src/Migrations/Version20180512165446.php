<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180512165446 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ecrire_annonce');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ecrire_annonce (id_member INT NOT NULL, id_advert INT NOT NULL, INDEX IDX_8A63A57A56D34F95 (id_member), INDEX IDX_8A63A57A72C641E6 (id_advert), PRIMARY KEY(id_member, id_advert)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ecrire_annonce ADD CONSTRAINT FK_8A63A57A56D34F95 FOREIGN KEY (id_member) REFERENCES members (id_member)');
        $this->addSql('ALTER TABLE ecrire_annonce ADD CONSTRAINT FK_8A63A57A72C641E6 FOREIGN KEY (id_advert) REFERENCES adverts (id_advert)');
    }
}

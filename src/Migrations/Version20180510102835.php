<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180510102835 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        //$this->addSql('ALTER TABLE comments CHANGE id_comment id_comment INT NOT NULL');
        //$this->addSql('ALTER TABLE ecrire_commentaire DROP PRIMARY KEY');
        //$this->addSql('ALTER TABLE ecrire_commentaire ADD PRIMARY KEY (id_advert, id_comment, id_member)');
        $this->addSql('ALTER TABLE members ADD repeat_pw LONGTEXT NOT NULL');
        //$this->addSql('ALTER TABLE ecrire_annonce RENAME INDEX fk_ecrire_annonce_id_advert TO IDX_8A63A57A72C641E6');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        //$this->addSql('ALTER TABLE comments CHANGE id_comment id_comment INT AUTO_INCREMENT NOT NULL');
        //$this->addSql('ALTER TABLE ecrire_annonce RENAME INDEX idx_8a63a57a72c641e6 TO FK_ecrire_annonce_id_advert');
        //$this->addSql('ALTER TABLE ecrire_commentaire DROP PRIMARY KEY');
        //$this->addSql('ALTER TABLE ecrire_commentaire ADD PRIMARY KEY (id_member, id_comment, id_advert)');
        $this->addSql('ALTER TABLE members DROP repeat_pw');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\FileReader;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200614124350 extends AbstractMigration
{

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE authority (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, authority VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kontakt (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, house_number VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kontakt_open_hours (kontakt_id INT NOT NULL, open_hours_id INT NOT NULL, INDEX IDX_4B4CB97DC4062E7F (kontakt_id), INDEX IDX_4B4CB97D77CF38C (open_hours_id), PRIMARY KEY(kontakt_id, open_hours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, message LONGTEXT NOT NULL, answered TINYINT(1) NOT NULL, INDEX IDX_B6BD307FF624B39D (sender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nav_bar_href (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE open_hours (id INT AUTO_INCREMENT NOT NULL, day VARCHAR(255) NOT NULL, open VARCHAR(255) NOT NULL, close VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE problem (id INT AUTO_INCREMENT NOT NULL, image_id INT NOT NULL, url_path VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D7E7CCC83DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proza (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, tresc LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sender (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slideshow (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slideshow_image (slideshow_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_C16D18788B14E343 (slideshow_id), INDEX IDX_C16D18783DA5256D (image_id), PRIMARY KEY(slideshow_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) unique NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usluga (id INT AUTO_INCREMENT NOT NULL, zabieg_id INT NOT NULL, category VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, price_once DOUBLE PRECISION DEFAULT NULL, price_series DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_679CE960C234D53B (zabieg_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zabieg (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, category VARCHAR(255) NOT NULL, url_path VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price_once DOUBLE PRECISION NOT NULL, price_series DOUBLE PRECISION DEFAULT NULL, duration INT NOT NULL, UNIQUE INDEX UNIQ_A25C75C73DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kontakt_open_hours ADD CONSTRAINT FK_4B4CB97DC4062E7F FOREIGN KEY (kontakt_id) REFERENCES kontakt (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kontakt_open_hours ADD CONSTRAINT FK_4B4CB97D77CF38C FOREIGN KEY (open_hours_id) REFERENCES open_hours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES sender (id)');
        $this->addSql('ALTER TABLE problem ADD CONSTRAINT FK_D7E7CCC83DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE slideshow_image ADD CONSTRAINT FK_C16D18788B14E343 FOREIGN KEY (slideshow_id) REFERENCES slideshow (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE slideshow_image ADD CONSTRAINT FK_C16D18783DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usluga ADD CONSTRAINT FK_679CE960C234D53B FOREIGN KEY (zabieg_id) REFERENCES zabieg (id)');
        $this->addSql('ALTER TABLE zabieg ADD CONSTRAINT FK_A25C75C73DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE problem DROP FOREIGN KEY FK_D7E7CCC83DA5256D');
        $this->addSql('ALTER TABLE slideshow_image DROP FOREIGN KEY FK_C16D18783DA5256D');
        $this->addSql('ALTER TABLE zabieg DROP FOREIGN KEY FK_A25C75C73DA5256D');
        $this->addSql('ALTER TABLE kontakt_open_hours DROP FOREIGN KEY FK_4B4CB97DC4062E7F');
        $this->addSql('ALTER TABLE kontakt_open_hours DROP FOREIGN KEY FK_4B4CB97D77CF38C');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF624B39D');
        $this->addSql('ALTER TABLE slideshow_image DROP FOREIGN KEY FK_C16D18788B14E343');
        $this->addSql('ALTER TABLE usluga DROP FOREIGN KEY FK_679CE960C234D53B');
        $this->addSql('DROP TABLE authority');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE kontakt');
        $this->addSql('DROP TABLE kontakt_open_hours');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE nav_bar_href');
        $this->addSql('DROP TABLE open_hours');
        $this->addSql('DROP TABLE problem');
        $this->addSql('DROP TABLE proza');
        $this->addSql('DROP TABLE sender');
        $this->addSql('DROP TABLE slideshow');
        $this->addSql('DROP TABLE slideshow_image');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE usluga');
        $this->addSql('DROP TABLE zabieg');
    }
}

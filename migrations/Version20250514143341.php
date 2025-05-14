<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514143341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, parcours_id INT DEFAULT NULL, descriptif VARCHAR(255) DEFAULT NULL, consigne VARCHAR(255) DEFAULT NULL, position INT NOT NULL, intitule VARCHAR(255) NOT NULL, INDEX IDX_285F75DD6E38C0DB (parcours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE etape_rendu (etape_id INT NOT NULL, rendu_id INT NOT NULL, INDEX IDX_9AE50AC74A8CA2AD (etape_id), INDEX IDX_9AE50AC7C974D9ED (rendu_id), PRIMARY KEY(etape_id, rendu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, date_heure DATETIME NOT NULL, INDEX IDX_B6BD307FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE message_rendu (message_id INT NOT NULL, rendu_id INT NOT NULL, INDEX IDX_D5D97152537A1329 (message_id), INDEX IDX_D5D97152C974D9ED (rendu_id), PRIMARY KEY(message_id, rendu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE parcours (id INT AUTO_INCREMENT NOT NULL, objet VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE rendu (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, date_heure DATETIME NOT NULL, INDEX IDX_2A7F8EB99D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, etape_id INT DEFAULT NULL, intitule VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, support JSON NOT NULL, nature JSON NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_939F45444A8CA2AD (etape_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, parcours_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, INDEX IDX_8D93D6496E38C0DB (parcours_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etape ADD CONSTRAINT FK_285F75DD6E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etape_rendu ADD CONSTRAINT FK_9AE50AC74A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etape_rendu ADD CONSTRAINT FK_9AE50AC7C974D9ED FOREIGN KEY (rendu_id) REFERENCES rendu (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message_rendu ADD CONSTRAINT FK_D5D97152537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message_rendu ADD CONSTRAINT FK_D5D97152C974D9ED FOREIGN KEY (rendu_id) REFERENCES rendu (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendu ADD CONSTRAINT FK_2A7F8EB99D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource ADD CONSTRAINT FK_939F45444A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D6496E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD6E38C0DB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etape_rendu DROP FOREIGN KEY FK_9AE50AC74A8CA2AD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etape_rendu DROP FOREIGN KEY FK_9AE50AC7C974D9ED
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message_rendu DROP FOREIGN KEY FK_D5D97152537A1329
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message_rendu DROP FOREIGN KEY FK_D5D97152C974D9ED
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendu DROP FOREIGN KEY FK_2A7F8EB99D86650F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource DROP FOREIGN KEY FK_939F45444A8CA2AD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496E38C0DB
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE etape
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE etape_rendu
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE message
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE message_rendu
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE parcours
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE rendu
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ressource
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}

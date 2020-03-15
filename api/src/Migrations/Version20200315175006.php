<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200315175006 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE media_object_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE care_case_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE postal_address (id UUID NOT NULL, street_address TEXT DEFAULT NULL, postal_code TEXT DEFAULT NULL, address_locality TEXT DEFAULT NULL, address_region TEXT DEFAULT NULL, address_country TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN postal_address.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, first_name VARCHAR(20) NOT NULL, last_name VARCHAR(128) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE media_object (id INT NOT NULL, file_path VARCHAR(255) DEFAULT NULL, directory VARCHAR(255) DEFAULT NULL, mime_type VARCHAR(255) DEFAULT NULL, size INT DEFAULT NULL, dimensions TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN media_object.dimensions IS \'(DC2Type:simple_array)\'');
        $this->addSql('CREATE TABLE care_case (id INT NOT NULL, senior_id UUID NOT NULL, volunteer_id UUID DEFAULT NULL, case_name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5F674803DF3BA4B5 ON care_case (case_name)');
        $this->addSql('CREATE INDEX IDX_5F674803AB8E2 ON care_case (senior_id)');
        $this->addSql('CREATE INDEX IDX_5F6748038EFAB6B1 ON care_case (volunteer_id)');
        $this->addSql('COMMENT ON COLUMN care_case.senior_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN care_case.volunteer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN care_case.status IS \'(DC2Type:App\\Enum\\CareCaseStatus)\'');
        $this->addSql('CREATE TABLE person (id UUID NOT NULL, address_id UUID DEFAULT NULL, given_name TEXT NOT NULL, family_name TEXT NOT NULL, email TEXT DEFAULT NULL, phone_number TEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, gender TEXT DEFAULT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD176E7927C74 ON person (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD176F5B7AF75 ON person (address_id)');
        $this->addSql('COMMENT ON COLUMN person.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN person.address_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN person.type IS \'(DC2Type:App\\Enum\\PersonType)\'');
        $this->addSql('ALTER TABLE care_case ADD CONSTRAINT FK_5F674803AB8E2 FOREIGN KEY (senior_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE care_case ADD CONSTRAINT FK_5F6748038EFAB6B1 FOREIGN KEY (volunteer_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176F5B7AF75 FOREIGN KEY (address_id) REFERENCES postal_address (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE person DROP CONSTRAINT FK_34DCD176F5B7AF75');
        $this->addSql('ALTER TABLE care_case DROP CONSTRAINT FK_5F674803AB8E2');
        $this->addSql('ALTER TABLE care_case DROP CONSTRAINT FK_5F6748038EFAB6B1');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE media_object_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE care_case_id_seq CASCADE');
        $this->addSql('DROP TABLE postal_address');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE media_object');
        $this->addSql('DROP TABLE care_case');
        $this->addSql('DROP TABLE person');
    }
}

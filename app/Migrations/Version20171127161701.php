<?php declare(strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171127161701 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fos_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', valid TINYINT(1) NOT NULL, last_modified DATETIME NOT NULL, UNIQUE INDEX UNIQ_4B019DDB5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_group_groups (parent_id INT NOT NULL, child_id INT NOT NULL, INDEX IDX_70177A5D727ACA70 (parent_id), INDEX IDX_70177A5DDD62C21B (child_id), PRIMARY KEY(parent_id, child_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orm_navi (id INT AUTO_INCREMENT NOT NULL, parent INT DEFAULT NULL, name VARCHAR(75) NOT NULL, file_param VARCHAR(75) DEFAULT NULL, url VARCHAR(75) DEFAULT NULL, position INT NOT NULL, `show` TINYINT(1) NOT NULL, valid TINYINT(1) NOT NULL, required_permission VARCHAR(1) DEFAULT \'r\' NOT NULL, icon VARCHAR(50) NOT NULL, last_modified DATETIME NOT NULL, INDEX IDX_C6D0CE493D8E604F (parent), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE son_permission (id INT AUTO_INCREMENT NOT NULL, operation VARCHAR(255) NOT NULL, contexts LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', class VARCHAR(255) DEFAULT NULL, field VARCHAR(255) DEFAULT NULL, last_modified DATETIME NOT NULL, INDEX operation_idx (operation), INDEX class_idx (class), INDEX field_idx (field), UNIQUE INDEX unique_permission_idx (operation, class, field), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE son_role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, valid TINYINT(1) NOT NULL, last_modified DATETIME NOT NULL, UNIQUE INDEX UNIQ_C49316505E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE son_role_roles (parent_id INT NOT NULL, child_id INT NOT NULL, INDEX IDX_E67BD858727ACA70 (parent_id), INDEX IDX_E67BD858DD62C21B (child_id), PRIMARY KEY(parent_id, child_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE son_role_permission (role_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_DCF8796FD60322AC (role_id), INDEX IDX_DCF8796FFED90CCA (permission_id), PRIMARY KEY(role_id, permission_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE son_sharing (id INT AUTO_INCREMENT NOT NULL, subject_class VARCHAR(244) NOT NULL, subject_id VARCHAR(36) NOT NULL, identity_class VARCHAR(244) NOT NULL, identity_name VARCHAR(244) NOT NULL, enabled TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', started_at DATETIME DEFAULT NULL, ended_at DATETIME DEFAULT NULL, last_modified DATETIME NOT NULL, identity_id INT NOT NULL, INDEX subject_class_idx (subject_class), INDEX subject_id_idx (subject_id), INDEX identity_class_idx (identity_class), INDEX identity_name_idx (identity_name), UNIQUE INDEX unique_sharing_idx (subject_class, subject_id, identity_class, identity_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE son_sharing_permissions (sharing_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_A9C9F7B48F15050 (sharing_id), INDEX IDX_A9C9F7BFED90CCA (permission_id), PRIMARY KEY(sharing_id, permission_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', name VARCHAR(50) NOT NULL, last_modified DATETIME NOT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user_groups (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_DA37EFBFA76ED395 (user_id), INDEX IDX_DA37EFBFFE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fos_group_groups ADD CONSTRAINT FK_70177A5D727ACA70 FOREIGN KEY (parent_id) REFERENCES fos_group (id)');
        $this->addSql('ALTER TABLE fos_group_groups ADD CONSTRAINT FK_70177A5DDD62C21B FOREIGN KEY (child_id) REFERENCES fos_group (id)');
        $this->addSql('ALTER TABLE orm_navi ADD CONSTRAINT FK_C6D0CE493D8E604F FOREIGN KEY (parent) REFERENCES orm_navi (id)');
        $this->addSql('ALTER TABLE son_role_roles ADD CONSTRAINT FK_E67BD858727ACA70 FOREIGN KEY (parent_id) REFERENCES son_role (id)');
        $this->addSql('ALTER TABLE son_role_roles ADD CONSTRAINT FK_E67BD858DD62C21B FOREIGN KEY (child_id) REFERENCES son_role (id)');
        $this->addSql('ALTER TABLE son_role_permission ADD CONSTRAINT FK_DCF8796FD60322AC FOREIGN KEY (role_id) REFERENCES son_role (id)');
        $this->addSql('ALTER TABLE son_role_permission ADD CONSTRAINT FK_DCF8796FFED90CCA FOREIGN KEY (permission_id) REFERENCES son_permission (id)');
        $this->addSql('ALTER TABLE son_sharing_permissions ADD CONSTRAINT FK_A9C9F7B48F15050 FOREIGN KEY (sharing_id) REFERENCES son_sharing (id)');
        $this->addSql('ALTER TABLE son_sharing_permissions ADD CONSTRAINT FK_A9C9F7BFED90CCA FOREIGN KEY (permission_id) REFERENCES son_permission (id)');
        $this->addSql('ALTER TABLE fos_user_groups ADD CONSTRAINT FK_DA37EFBFA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE fos_user_groups ADD CONSTRAINT FK_DA37EFBFFE54D947 FOREIGN KEY (group_id) REFERENCES fos_group (id)');
        
        $this->addSql('
            INSERT INTO `orm_navi` (`id`, `parent`, `name`, `file_param`, `url`, `position`, `show`, `valid`, `required_permission`, `icon`, `last_modified`) VALUES
            (1, NULL, "MainMenu.menu.homepageName", "index.php|", NULL, 0, 1, 1, "r", "", "2015-01-18 10:49:37"),
            (2, 1, "MainMenu.menu.homepage.login", "index.php|login", NULL, 0, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (3, 1, "MainMenu.menu.homepage.logout", "index.php|logout", NULL, 1, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (4, NULL, "MainMenu.menu.calendarName", "calendar.php|", NULL, 1, 1, 1, "r", "calendar-o", "2015-01-18 10:49:37"),
            (5, 4, "MainMenu.menu.calendar.new", "calendar.php|new", NULL, 0, 1, 1, "w", "", "2015-01-18 10:49:37"),
            (6, 4, "MainMenu.menu.calendar.listall", "calendar.php|listall", NULL, 1, 1, 1, "r", "list", "2015-01-18 10:49:37"),
            (7, 4, "MainMenu.menu.calendar.details", "calendar.php|details", NULL, 2, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (8, 4, "MainMenu.menu.calendar.edit", "calendar.php|edit", NULL, 3, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (9, 4, "MainMenu.menu.calendar.delete", "calendar.php|delete", NULL, 4, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (10, NULL, "MainMenu.menu.inventoryName", "inventory.php|", NULL, 2, 1, 1, "r", "book", "2015-01-18 10:49:37"),
            (11, 10, "MainMenu.menu.inventory.my", "inventory.php|my", NULL, 0, 1, 1, "r", "bookmark-o", "2015-01-18 10:49:37"),
            (12, 10, "MainMenu.menu.inventory.listall", "inventory.php|listall", NULL, 1, 1, 1, "r", "list", "2015-01-18 10:49:37"),
            (13, 10, "MainMenu.menu.inventory.give", "inventory.php|give", NULL, 2, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (14, 10, "MainMenu.menu.inventory.take", "inventory.php|take", NULL, 3, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (15, 10, "MainMenu.menu.inventory.cancel", "inventory.php|cancel", NULL, 4, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (16, 10, "MainMenu.menu.inventory.details", "inventory.php|details", NULL, 5, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (17, 10, "MainMenu.menu.inventory.movement", "inventory.php|movement", NULL, 6, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (18, NULL, "MainMenu.menu.announcementName", "announcement.php|", NULL, 3, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (19, 18, "MainMenu.menu.announcement.new", "announcement.php|new", NULL, 0, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (20, 18, "MainMenu.menu.announcement.edit", "announcement.php|edit", NULL, 1, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (21, 18, "MainMenu.menu.announcement.delete", "announcement.php|delete", NULL, 2, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (22, 18, "MainMenu.menu.announcement.details", "announcement.php|details", NULL, 3, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (23, 18, "MainMenu.menu.announcement.topdf", "announcement.php|topdf", NULL, 4, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (24, NULL, "MainMenu.menu.protocollName", "protocol.php|", NULL, 4, 1, 1, "r", "file-text-o", "2015-01-18 10:49:37"),
            (25, 24, "MainMenu.menu.protocoll.new", "protocol.php|new", NULL, 0, 1, 1, "w", "", "2015-01-18 10:49:37"),
            (26, 24, "MainMenu.menu.protocoll.listall", "protocol.php|listall", NULL, 1, 1, 1, "r", "list", "2015-01-18 10:49:37"),
            (27, 24, "MainMenu.menu.protocoll.details", "protocol.php|details", NULL, 2, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (28, 24, "MainMenu.menu.protocoll.edit", "protocol.php|edit", NULL, 3, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (29, 24, "MainMenu.menu.protocoll.show", "protocol.php|show", NULL, 4, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (30, 24, "MainMenu.menu.protocoll.topdf", "protocol.php|topdf", NULL, 5, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (31, 24, "MainMenu.menu.protocoll.correct", "protocol.php|correct", NULL, 6, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (32, 24, "MainMenu.menu.protocoll.delete", "protocol.php|delete", NULL, 7, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (33, 24, "MainMenu.menu.protocoll.showdecisions", "protocol.php|showdecisions", NULL, 8, 1, 1, "r", "check-square-o", "2015-01-18 10:49:37"),
            (34, NULL, "MainMenu.menu.administrationName", "administration.php|", NULL, 11, 1, 1, "r", "cogs", "2015-11-13 18:58:50"),
            (35, 34, "MainMenu.menu.administration.field", "administration.php|field", NULL, 0, 1, 1, "w", "table", "2015-01-18 10:49:37"),
            (37, NULL, "MainMenu.menu.fileName", "file.php|", NULL, 5, 1, 1, "r", "file", "2015-01-18 10:49:37"),
            (38, 37, "MainMenu.menu.file.listall", "file.php|listall", NULL, 0, 1, 1, "r", "files-o", "2015-01-18 10:49:37"),
            (39, 37, "MainMenu.menu.file.details", "file.php|details", NULL, 1, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (40, 37, "MainMenu.menu.file.edit", "file.php|edit", NULL, 2, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (41, 37, "MainMenu.menu.file.delete", "file.php|delete", NULL, 3, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (42, 37, "MainMenu.menu.file.upload", "file.php|upload", NULL, 4, 1, 1, "w", "upload", "2015-01-18 10:49:37"),
            (43, 37, "MainMenu.menu.file.cached", "file.php|cached", NULL, 5, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (44, 37, "MainMenu.menu.file.attach", "file.php|attach", NULL, 6, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (45, 34, "MainMenu.menu.administration.useradmin", "administration.php|user", NULL, 2, 1, 1, "r", "users", "2015-01-18 10:49:37"),
            (46, 34, "MainMenu.menu.administration.club", "administration.php|club", NULL, 3, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (47, NULL, "MainMenu.menu.resultName", "result.php|", NULL, 8, 1, 1, "r", "flag-checkered", "2015-11-13 18:58:50"),
            (48, 47, "MainMenu.menu.result.listall", "result.php|listall", NULL, 0, 1, 1, "r", "calendar", "2015-01-18 10:49:37"),
            (49, 47, "MainMenu.menu.result.details", "result.php|details", NULL, 1, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (50, 47, "MainMenu.menu.result.delete", "result.php|delete", NULL, 2, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (51, 47, "MainMenu.menu.result.new", "result.php|new", NULL, 3, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (52, 47, "MainMenu.menu.result.list", "result.php|list", NULL, 4, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (53, NULL, "MainMenu.menu.accountingName", "accounting.php|", NULL, 9, 1, 1, "r", "money", "2015-11-13 18:58:50"),
            (54, 53, "MainMenu.menu.accounting.dashboard", "accounting.php|dashboard", NULL, 0, 1, 1, "r", "dashboard", "2015-01-18 10:49:37"),
            (55, 53, "MainMenu.menu.accounting.task", "accounting.php|task", NULL, 1, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (56, 53, "MainMenu.menu.accounting.settings", "accounting.php|settings", NULL, 2, 1, 1, "r", "cog", "2015-01-18 10:49:37"),
            (57, 37, "MainMenu.menu.file.download", "file.php|download", NULL, 7, 0, 1, "r", "", "2015-01-18 10:49:37"),
            (58, 34, "MainMenu.menu.administration.newYear", "administration.php|newyear", NULL, 1, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (59, 18, "MainMenu.menu.announcement.refreshpdf", "announcement.php|refreshpdf", NULL, 5, 0, 1, "w", "", "2015-01-18 10:49:37"),
            (60, 4, "MainMenu.menu.calendar.calendar", "calendar.php|calendar", NULL, 5, 1, 1, "r", "calendar", "2015-11-13 18:58:50"),
            (61, 47, "MainMenu.menu.result.accounting", "result.php|accounting", NULL, 5, 0, 1, "r", "", "2015-01-18 13:06:32"),
            (62, 34, "MainMenu.menu.administration.schoolholidays", "administration.php|schoolholidays", NULL, 2, 1, 1, "w", "calendar", "2015-11-13 18:58:50"),
            (63, 4, "MainMenu.menu.calendar.schedule", "calendar.php|schedule", NULL, 6, 1, 1, "r", "list-alt", "2015-11-13 18:58:50"),
            (64, NULL, "MainMenu.menu.tributeName", "tribute.php|", NULL, 10, 1, 1, "r", "gift", "2015-11-13 18:58:50"),
            (65, 64, "MainMenu.menu.tribute.listall", "tribute.php|listall", NULL, 0, 1, 1, "r", "list", "2015-11-13 18:58:50"),
            (66, 64, "MainMenu.menu.tribute.new", "tribute.php|new", NULL, 1, 1, 1, "w", "", "2016-01-08 17:09:59"),
            (67, 64, "MainMenu.menu.tribute.edit", "tribute.php|edit", NULL, 2, 0, 1, "w", "", "2016-01-08 17:09:59"),
            (68, 64, "MainMenu.menu.tribute.delete", "tribute.php|delete", NULL, 3, 0, 1, "w", "", "2016-01-08 17:09:59"),
            (69, 37, "MainMenu.menu.file.logo", "file.php|logo", NULL, 8, 1, 1, "w", "", "2017-05-22 07:25:57")
        ');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_group_groups DROP FOREIGN KEY FK_70177A5D727ACA70');
        $this->addSql('ALTER TABLE fos_group_groups DROP FOREIGN KEY FK_70177A5DDD62C21B');
        $this->addSql('ALTER TABLE fos_user_groups DROP FOREIGN KEY FK_DA37EFBFFE54D947');
        $this->addSql('ALTER TABLE orm_navi DROP FOREIGN KEY FK_C6D0CE493D8E604F');
        $this->addSql('ALTER TABLE son_role_permission DROP FOREIGN KEY FK_DCF8796FFED90CCA');
        $this->addSql('ALTER TABLE son_sharing_permissions DROP FOREIGN KEY FK_A9C9F7BFED90CCA');
        $this->addSql('ALTER TABLE son_role_roles DROP FOREIGN KEY FK_E67BD858727ACA70');
        $this->addSql('ALTER TABLE son_role_roles DROP FOREIGN KEY FK_E67BD858DD62C21B');
        $this->addSql('ALTER TABLE son_role_permission DROP FOREIGN KEY FK_DCF8796FD60322AC');
        $this->addSql('ALTER TABLE son_sharing_permissions DROP FOREIGN KEY FK_A9C9F7B48F15050');
        $this->addSql('ALTER TABLE fos_user_groups DROP FOREIGN KEY FK_DA37EFBFA76ED395');
        $this->addSql('DROP TABLE fos_group');
        $this->addSql('DROP TABLE fos_group_groups');
        $this->addSql('DROP TABLE orm_navi');
        $this->addSql('DROP TABLE son_permission');
        $this->addSql('DROP TABLE son_role');
        $this->addSql('DROP TABLE son_role_roles');
        $this->addSql('DROP TABLE son_role_permission');
        $this->addSql('DROP TABLE son_sharing');
        $this->addSql('DROP TABLE son_sharing_permissions');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE fos_user_groups');
    }
}

<?php

use yii\db\Schema;
use yii\db\Migration;

class m160126_182024_create_table_note extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `evrnt_note` (
              `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
              `text` TEXT NOT NULL COMMENT '',
              `creator` INT NOT NULL COMMENT '',
              `date_create` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
              PRIMARY KEY (`id`)  COMMENT '',
              INDEX `fk_evrnt_note_1_idx` (`creator` ASC)  COMMENT '')
            ENGINE = InnoDB CHARACTER SET UTF8
        ");
    }

    public function safeDown()
    {
        $this->execute("
            DROP TABLE IF EXISTS `evrnt_note`;
        ");
    }
}

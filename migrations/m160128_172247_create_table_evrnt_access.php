<?php

use yii\db\Schema;
use yii\db\Migration;

class m160128_172247_create_table_evrnt_access extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `evrnt_access` (
              `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
              `note_id` INT NOT NULL COMMENT '',
              `user_id` INT NOT NULL COMMENT '',
              PRIMARY KEY (`id`)  COMMENT '',
              INDEX `fk_evrnt_access_1_idx` (`note_id` ASC)  COMMENT '',
              INDEX `fk_evrnt_access_2_idx` (`user_id` ASC)  COMMENT '')
            ENGINE = InnoDB CHARACTER SET UTF8
        ");
    }

    public function safeDown()
    {
        $this->execute("
            DROP TABLE IF EXISTS `evrnt_access`;
        ");
    }
}

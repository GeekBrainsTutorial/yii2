<?php

use yii\db\Schema;
use yii\db\Migration;

class m160209_141850_create_table_logn_history extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `evrnt_login_history` (
              `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
              `user_id` INT NOT NULL COMMENT '',
              `date_time` DATETIME NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
              PRIMARY KEY (`id`)  COMMENT '',
              INDEX `fk_evrnt_login_history_1_idx` (`user_id` ASC)  COMMENT '',
              CONSTRAINT `fk_evrnt_login_history_1`
                FOREIGN KEY (`user_id`)
                REFERENCES `evrnt_user` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB CHARACTER SET UTF8
        ");
    }

    public function safeDown()
    {
        $this->execute("
            DROP TABLE IF EXISTS `evrnt_login_history`;
        ");
    }
}

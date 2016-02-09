<?php

namespace app\commands;

use app\models\LoginHistory;
use yii\console\Controller;

/**
 * Class CronController
 * @package app\commands
 */
class CronController extends Controller
{
    public function actionClearlh()
    {
        $deleted = LoginHistory::deleteAll();
        if($deleted) {
            echo "Deleted $deleted row \n";
            return true;
        }
        else {
            echo "Not exist new log\n";
        }

    }
}

<?php

namespace ofixone\admin\console;

use ofixone\admin\interfaces\AdminInterface;
use ofixone\admin\Module;
use yii\console\Controller;
use Yii;
use yii\db\ActiveRecord;
use yii\console\ExitCode;
use yii\web\IdentityInterface;

class AuthController extends Controller
{
    /**
     * Create admin record
     * @return int
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        /**
         * @var Module $module
         */
        $module = Yii::$app->controller->module;
        $modelClass = $module->adminModel;
        echo 'Create new admin? [Yes - to continue, any other - to cancel]: ';
        $agree = fgets(STDIN);
        if (strtolower(trim($agree)) == 'yes') {
            do {
                echo 'Login (admin): ';
                $login = strtolower(trim(fgets(STDIN)));
                if (!empty($login)) {
                    if (preg_match('/^[a-zA-Z0-9_]{1,}$/', $login)) {
                        break;
                    } else {
                        echo 'Incorrect value! Only a-Z,0-9,_ is available' . PHP_EOL;
                    }
                } else {
                    $login = 'admin';
                    break;
                }
            } while (1);
            do {
                echo 'Password (generate randomly): ';
                $password = strtolower(trim(fgets(STDIN)));
                if (!empty($password)) {
                    if (preg_match('/^[a-zA-Z0-9_]{1,}$/', $password)) {
                        break;
                    } else {
                        echo 'Incorrect value! Only a-Z,0-9,_ is available' . PHP_EOL;
                    }
                } else {
                    $password = Yii::$app->security->generateRandomString(8);
                    break;
                }
            } while (1);
            /**
             * @var ActiveRecord|AdminInterface $user
             */
            $user = new $modelClass();
            $user->setLogin($login);
            $user->setPassword($password);
            if ($user->save()) {
                echo 'Success! User "' . $login .
                    '" created with id #' . $user->getId() .
                    ', password "' . $password . '"' . PHP_EOL;
            } else {
                echo 'Oops, something trouble : ' . implode(",", $user->getFirstErrors());
                return ExitCode::UNSPECIFIED_ERROR;
            }
        }
        return ExitCode::OK;
    }
}
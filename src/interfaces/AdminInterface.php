<?php

namespace ofixone\admin\interfaces;

use yii\web\IdentityInterface;

interface AdminInterface extends IdentityInterface
{
    public function getLogin(): string;
    public function setLogin($value);
    public function setPassword($value);
    public function getPasswordHash(): string;
}
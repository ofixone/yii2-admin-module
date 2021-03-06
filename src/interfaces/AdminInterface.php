<?php

namespace ofixone\admin\interfaces;

use yii\web\IdentityInterface;

interface AdminInterface extends IdentityInterface
{
    public function getLogin(): string;
    public function setLogin($value);
    public function setPassword($value);
    public function getPasswordHash(): string;
    public function getStatusString(): string;
    public function getStatusName(): string;
    public function getStatusClass(): string;
}
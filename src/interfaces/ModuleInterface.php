<?php

namespace ofixone\admin\interfaces;

interface ModuleInterface
{
    public function addRules(): array;
    public function addMenuItem(): array;
}
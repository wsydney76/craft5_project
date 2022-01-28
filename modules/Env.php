<?php

namespace modules;

class Env
{

    public const CP_VARIABLES = [];

    static public function setCpVars()
    {
        foreach (static::CP_VARIABLES as $key => $value) {
            $_SERVER[$key] = $value;
        };
    }
}

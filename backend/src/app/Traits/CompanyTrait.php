<?php

namespace App\Traits;

use App\Scopes\CompanyScope;

trait CompanyTrait
{
    public static function bootCompanyTrait()
    {
        static::addGlobalScope(new CompanyScope());
    }
}

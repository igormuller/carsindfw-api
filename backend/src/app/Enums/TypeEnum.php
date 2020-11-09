<?php

namespace App\Enums;

abstract class TypeEnum extends Enum
{
    const PLAN_OPENED          = "opened";
    const PLAN_WARNING         = "warning";
    const PLAN_WAITING_PAYMENT = "waiting_payment";
    const PLAN_ENCERRED        = "encerred";

    public static function getPlanStatus()
    {
        return [
            self::PLAN_OPENED,
            self::PLAN_WARNING,
            self::PLAN_WAITING_PAYMENT,
            self::PLAN_ENCERRED,
        ];
    }
}

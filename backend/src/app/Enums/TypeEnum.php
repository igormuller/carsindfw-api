<?php

namespace App\Enums;

abstract class TypeEnum extends Enum
{
    const COMPANY_STATUS_OPENED          = "opened";
    const COMPANY_STATUS_CANCELED        = "canceled";
    const COMPANY_STATUS_WARNING         = "warning";
    const COMPANY_STATUS_WARNING_PAYMENT = "warning_payment";

    public static function getPlanStatus()
    {
        return [
            self::COMPANY_STATUS_OPENED,
            self::COMPANY_STATUS_WARNING,
            self::COMPANY_STATUS_WARNING_PAYMENT,
            self::COMPANY_STATUS_CANCELED,
        ];
    }
}

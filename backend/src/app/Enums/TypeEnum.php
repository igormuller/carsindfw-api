<?php

namespace App\Enums;

abstract class TypeEnum extends Enum
{
    const COMPANY_STATUS_ACTIVED         = "actived";
    const COMPANY_STATUS_CANCELED        = "canceled";
    const COMPANY_STATUS_WARNING         = "warning";
    const COMPANY_STATUS_WARNING_PAYMENT = "warning_payment";

    public static function getCompanyStatus()
    {
        return [
            self::COMPANY_STATUS_ACTIVED,
            self::COMPANY_STATUS_WARNING,
            self::COMPANY_STATUS_WARNING_PAYMENT,
            self::COMPANY_STATUS_CANCELED,
        ];
    }

    public static function getCompanyStatusName($status)
    {
        $data = [
            self::COMPANY_STATUS_ACTIVED         => 'Actived',
            self::COMPANY_STATUS_WARNING         => 'Warning',
            self::COMPANY_STATUS_WARNING_PAYMENT => 'Warning Payment',
            self::COMPANY_STATUS_CANCELED        => 'Canceled',
        ];
        return $data[$status];
    }
}

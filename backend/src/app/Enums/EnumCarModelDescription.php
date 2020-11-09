<?php

namespace App\Enums;

abstract class EnumCarModelDescription extends Enum
{
    // body_type
    const CONVERTIBLE = 'convertible';
    const COUPE       = 'coupe';
    const HATCHBACK   = 'hatchback';
    const MINIVAN     = 'minivan';
    const SEDAN       = 'sedan';
    const SUV         = 'suv';
    const TRUCK       = 'truck';
    const VAN         = 'van';
    const WAGON       = 'wagon';

    // fuel_type
    const GAS         = 'gas';
    const DIESEL      = 'diesel';
    const ELECTRIC    = 'electric';
    const HYBRID      = 'hybrid';
    const FLEX_FUEL   = 'flex_fuel';
    const NATURAL_GAS = 'natural_gas';

    // transmission_type
    const MANUAL              = 'manual';
    const AUTOMATIC           = 'automatic';
    const CVT                 = 'cvt';
    const EVT                 = 'evt';
    const DIRECT_DRIVE        = 'direct_drive';
    const SHIFTABLE_AUTOMATIC = 'shiftable_automatic';
    const AUTOMATED_MANUAL    = 'automated_manual';

    public static function getBodyTypes()
    {
        return [
            self::CONVERTIBLE,
            self::COUPE,
            self::HATCHBACK,
            self::MINIVAN,
            self::SEDAN,
            self::SUV,
            self::TRUCK,
            self::VAN,
            self::WAGON,
        ];
    }

    public static function getBodyTypeName($item)
    {
        $body_types = [
            self::CONVERTIBLE => 'Convertible',
            self::COUPE       => 'Coupe',
            self::HATCHBACK   => 'Hatchback',
            self::MINIVAN     => 'Minivan',
            self::SEDAN       => 'Sedan',
            self::SUV         => 'SUV',
            self::TRUCK       => 'Truck',
            self::VAN         => 'Van',
            self::WAGON       => 'Wagon',
        ];
        return $body_types[$item];
    }

    public static function getTransmissionTypes()
    {
        return [
            self::MANUAL,
            self::AUTOMATIC,
            self::CVT,
            self::EVT,
            self::DIRECT_DRIVE,
            self::SHIFTABLE_AUTOMATIC,
            self::AUTOMATED_MANUAL,
        ];
    }

    public static function getTransmissionTypeName($item)
    {
        $transmission_type = [
            self::MANUAL              => 'Manual',
            self::AUTOMATIC           => 'Automatic',
            self::CVT                 => 'CVT',
            self::EVT                 => 'EVT',
            self::DIRECT_DRIVE        => 'Direct Drive',
            self::SHIFTABLE_AUTOMATIC => 'Shiftable Automatic',
            self::AUTOMATED_MANUAL    => 'Automated Manual',
        ];

        return $transmission_type[$item];
    }

    public static function getFuelTypes()
    {
        return [
            self::GAS,
            self::DIESEL,
            self::ELECTRIC,
            self::HYBRID,
            self::FLEX_FUEL,
            self::NATURAL_GAS,
        ];
    }

    public static function getFuelTypeName($item)
    {
        $fuel_type = [
            self::GAS         => 'Gasoline',
            self::DIESEL      => 'Diesel',
            self::ELECTRIC    => 'Electric',
            self::HYBRID      => 'Hybrid',
            self::FLEX_FUEL   => 'Flex Fuel',
            self::NATURAL_GAS => 'Natural Gas',
        ];
        return $fuel_type[$item];
    }
}

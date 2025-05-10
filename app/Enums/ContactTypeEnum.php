<?php

namespace App\Enums;

enum ContactTypeEnum: int{
    case EMAIL = 1;
    case PHONE = 2;

    public static function getKeyByValue(int $value): ?string
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case->name;
            }
        }
        return null;
    }
}

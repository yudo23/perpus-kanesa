<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserEnum extends Enum
{
    const STATUS_ACTIVE_TRUE = 1;
    const STATUS_ACTIVE_FALSE = 0;

    public static function status()
    {
        $list = [
            self::STATUS_ACTIVE_TRUE => "Aktif",
            self::STATUS_ACTIVE_FALSE => "Tidak Aktif",
        ];
        
        return $list;
    }

}

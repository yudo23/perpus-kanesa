<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;
use Auth;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RoleEnum extends Enum
{
    const SUPERADMIN = "Superadmin";
    const ADMINISTRATOR = "Administrator";
    const STUDENT = "Student";

    public static function roles()
    {
        $roles = [
            self::SUPERADMIN,
            self::ADMINISTRATOR,
        ];
        
        return $roles;
    }
}

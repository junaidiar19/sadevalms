<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RoleEnum extends Enum
{
    const SUPER_ADMIN = 'super_admin';

    const ADMIN = 'admin';

    const TEACHER = 'teacher';

    const STUDENT = 'student';
}

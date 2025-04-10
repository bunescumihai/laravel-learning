<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case CLIENT = 'client';
    case MANAGER = 'manager';
}



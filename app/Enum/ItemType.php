<?php

namespace App\Enum;

use App\Traits\Enumable;

enum ItemType: string
{
    use Enumable;
    case Login = 'login';
    case Card = 'card';
    case Identity = 'identity';
    case Note = 'note';
}

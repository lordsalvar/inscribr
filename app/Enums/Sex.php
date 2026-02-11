<?php

namespace App\Enums;

enum Sex: string
{
    case MALE = 'Male';
    case FEMALE = 'Female';
    case OTHER = 'Other';
    case UNKNOWN = 'Unknown';
}

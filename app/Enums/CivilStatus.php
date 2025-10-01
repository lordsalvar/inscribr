<?php

namespace App\Enums;

enum CivilStatus: string
{
    case SINGLE = 'Single';
    case MARRIED = 'Married';
    case WIDOWED = 'Widowed';
    case SEPARATED = 'Separated';
    case DIVORCED = 'Divorced';
}

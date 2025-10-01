<?php

namespace App\Enums;

enum EmploymentStatus: string
{
    case REGULAR = 'Regular';
    case JO = 'Job Order';
    case COS = 'Contract of Service';
}

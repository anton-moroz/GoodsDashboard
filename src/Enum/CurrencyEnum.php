<?php

namespace App\Enum;

/**
 * Contains list of currency codes and names.
 */
enum CurrencyEnum: string
{
    case EUR = 'Euro';
    case UAH = 'Hryvnia';
    case USD = 'American Dollar';
}

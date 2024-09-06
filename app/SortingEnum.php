<?php

namespace App;

enum SortingEnum: int
{
    case POPULARITY = 1;
    case HIGH_TO_LOW = 2;
    case LOW_TO_HIGH = 3;
}

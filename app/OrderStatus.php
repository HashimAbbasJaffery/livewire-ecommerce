<?php

namespace App;

enum OrderStatus: int
{
    case INPROGRESS = 0;
    case DISPATCHED = 1;
    case DELIVERED = 2;
    case RETURNED = 3;
    case CANCELLED = 4;
}

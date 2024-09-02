<?php

namespace App;

enum OrderStatus
{
    case INPROGRESS = 0;
    case DISPATCHED = 1;
    case DELIVERED = 2;
    case CANCELLED = 3;
}

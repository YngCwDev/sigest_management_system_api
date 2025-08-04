<?php

namespace App\Enums;

enum OrderStatus:string
{
    case PENDING = "pending";
    case PROCESSING = "processing";
    case CANCELLED = "cancelled";
    case COMPLETED = "completed";
    
}

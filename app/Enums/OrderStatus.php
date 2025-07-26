<?php

namespace App\Enums;

enum OrderStatus
{
    case PENDING = "pendente";
    case PROCESSING = "processando";
    case CANCELLED = "cancelado";
    case COMPLETED = "concluido";
    
}

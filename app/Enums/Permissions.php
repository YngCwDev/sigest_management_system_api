<?php

namespace App\Enums;

enum Permissions: string
{
    case SHOW = "show";
    case CREATE = "create";
    case UPDATE = "update";
    case CANCEL = "cancel";
    case DELETE = "delete";

    case ALL = "all";
}

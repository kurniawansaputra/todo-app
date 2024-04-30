<?php

namespace App\Enums;

enum TodoStatus: string
{
    case ON_PROGRESS = 'On Progress';
    case DONE = 'Done';
}

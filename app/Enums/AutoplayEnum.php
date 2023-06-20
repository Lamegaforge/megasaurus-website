<?php

namespace App\Enums;

enum AutoplayEnum: string
{
    case Cookie = 'autoplay-cookie';
    case Storage = 'autoplay-session';
}

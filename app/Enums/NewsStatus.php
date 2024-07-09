<?php

namespace App\Enums;

enum NewsStatus: String
{
    case Draft = "draft";
    case Pending = "pending";
    case Published = "published";
}

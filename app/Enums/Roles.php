<?php

namespace App\Enums;

enum Roles: String
{
    case Admin = "admin";
    case Moderator = "moderator";
    case Author = "author";
    case Viewer = "viewer";
}

<?php

namespace App\Enums;

enum PaginatedNumber: int
{
    const GuestNews = 10;
    const GuestComments = 5;
    const News = 20;
    const Comments = 20;
    const Categories = 20;
    const Queries = 20;
    const Tags = 20;
    const Notifications = 20;
    const UnreadNotifications = 5;
}

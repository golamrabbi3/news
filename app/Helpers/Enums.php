<?php

enum PaginatedNumber: int
{
    const GuestNews = 10;
    const GuestComments = 5;
    const News = 20;
    const Comments = 20;
    const Categories = 20;
    const Tags = 20;
}

enum Roles: String
{
    case Admin = "admin";
    case Moderator = "moderator";
    case Author = "author";
    case Viewer = "viewer";
}

enum NewsStatus: String
{
    case Draft = "draft";
    case Pending = "pending";
    case Published = "published";
}

enum MediaPath: String
{
    const Avatar = "media/avatar";
    const News = "media/news";
    const Categories = "media/categories";
}

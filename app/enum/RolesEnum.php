<?php

namespace App\enum;

enum RolesEnum:string
{
    case Admin = 'admin';
    case Commenter = 'commenter';
    case User = 'user';

    public static function getRoles(): array
    {
        return [
            self::Admin->value =>"Admin",
            self::Commenter->value =>"Commenter",
            self::User->value =>"User",
        ];
    }
    public static function labels(): array
    {
        return [
            self::Admin->value => 'Admin',
            self::Commenter->value => 'Commenter',
            self::User->value => 'User',
        ];
    }
    public function label(): string
    {
        return match ($this) {
            self::Admin =>"Admin",
            self::Commenter =>"Commenter",
            self::User => "User",
         };
}

}

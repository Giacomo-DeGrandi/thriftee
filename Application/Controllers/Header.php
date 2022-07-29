<?php

namespace Application\Controllers\Header;

class Header
{
    public static function execute(): string
    {
        return 'Templates/Header.php';
    }

    public static function executeParams(mixed $params): string
    {
        return 'Templates/Header.php';
    }
}

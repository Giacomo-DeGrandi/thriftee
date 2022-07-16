<?php

namespace Application\Lib\Token;


Class Token {


    public function generateToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    public function generateExpiration(): int
    {
        return time() + 3600; // 1 hour = 3600 secs
    }

}

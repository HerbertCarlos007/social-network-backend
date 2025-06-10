<?php

namespace App\DTO;

class UserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $avatar_url,
        public string $password,
    ){}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'avatar_url' => $this->avatar_url,
            'password' => $this->password,
        ];
    }
}

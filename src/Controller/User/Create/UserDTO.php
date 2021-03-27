<?php

namespace App\Controller\User\Create;

use App\Common\DataTransferObjectInteface;

class UserDTO implements DataTransferObjectInteface
{
    private string $name;
    private string $email;
    private string $cpf;
    private string $cnh;
    private string $roles;
    private string $password;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getRoles(): string
    {
        return $this->roles;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setRoles(string $roles): void
    {
        $this->roles = $roles;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getCnh(): string
    {
        return $this->cnh;
    }

    public function setCnh(string $cnh): void
    {
        $this->cnh = $cnh;
    }
}

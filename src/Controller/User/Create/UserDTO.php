<?php

namespace App\Controller\User\Create;

use App\Common\DataTransferObjectInteface;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *     request="CreateUserDTO",
 *     required=true,
 *     @OA\JsonContent(
 *          @OA\Property(type="string", property="name", default="antoino"),
 *          @OA\Property(type="string", property="email", default="user@gmail.com"),
 *          @OA\Property(type="string", property="cpf", default="68308284914"),
 *          @OA\Property(type="string", property="cnh", default="1332341242"),
 *          @OA\Property(type="string", property="roles", default="ROLE_USER"),
 *          @OA\Property(type="string", property="password", default="AmarElo_2"),
 *    )
 * )
 */
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

<?php

namespace App\MoneyTransfer\User;

use App\Controller\User\Create\UserDTO;
use App\MoneyTransfer\Wallet\Wallet;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Uid\Uuid;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="users")
 */

class User implements UserInterface, \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", unique=true, length=255)
     */
    private string $uuid;

    /**
     * @OA\Property(type="string", default="carlos")
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="o nome não pode ser nulo", payload={"severity"="error"})
     * @Assert\Type(type="string")
     */
    private string $name;

    /**
     * @OA\Property(type="email", default="shopkeeper@gmail.com")
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="O email não pode ser nulo")
     * @Assert\Email(
     *     message="O email não é um email valido"
     * )
     * @Assert\Type(type="string")
     */
    private string $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(
     *     message="O cpf não pode ser nulo"
     * )
     * @Assert\Type(type="string")
     */
    private string $cpf;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(
     *     message="o cnh não pode ser nulo"
     * )
     * @Assert\Type(type="string")
     */
    private string $cnh;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="a senha não pode ser nulo"
     * )
     * @Assert\Type(type="string")
     */
    private string $password;

    /**
     * @OA\Property(type="roles", default="ROLE_SHOPKEEPER")
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="a senha não pode ser nulo",
     *     payload={"severity"="error"}
     * )
     */
    private string $roles;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $updated_at;

    /**
     * @ORM\OneToOne(targetEntity="App\MoneyTransfer\Wallet\Wallet", inversedBy="user", cascade="persist")
     */
    private Wallet $wallet;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
        $this->created_at = new DateTime('now');
        $this->updated_at = new DateTime('now');
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCnh(): string
    {
        return $this->cnh;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updated_at;
    }

    public function getRoles(): string
    {
        return $this->roles;
    }

    public function setRoles($roles): self
    {
        if (is_array($roles)) {
            $this->roles = implode(',', $roles);
        }
        if (is_string($roles)) {
            $this->roles = $roles;
        }

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public static function make(UserDTO $userDTO): self
    {
        $wallet = new Wallet();
        $wallet->setMoney($userDTO->getMoney());

        return (new self())
            ->setName($userDTO->getName())
            ->setEmail($userDTO->getEmail())
            ->setCpf($userDTO->getCpf())
            ->setCnh($userDTO->getCnh())
            ->setRoles($userDTO->getRoles())
            ->setWallet($wallet);
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function setCnh(string $cnh): self
    {
        $this->cnh = $cnh;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getWallet(): Wallet
    {
        return $this->wallet;
    }

    public function setWallet(Wallet $wallet): self
    {
        $this->wallet = $wallet;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->getName(),
            'roles' => $this->getRoles(),
            'email' => $this->getEmail(),
        ];
    }
}

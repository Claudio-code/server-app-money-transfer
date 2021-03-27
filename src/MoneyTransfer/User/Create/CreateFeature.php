<?php

namespace App\MoneyTransfer\User\Create;

use App\Controller\User\Create\UserDTO;
use App\MoneyTransfer\User\User;
use App\MoneyTransfer\User\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateFeature
{
    private UserPasswordEncoderInterface $userPasswordEncoder;
    private UserRepository $userRepository;

    public function __construct(
        UserPasswordEncoderInterface $userPasswordEncoder,
        UserRepository $userRepository,
    ) {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->userRepository = $userRepository;
    }

    public function execute(UserDTO $userDTO)
    {
        $user = $this->userRepository->findOneBy([
            'cpf' => $userDTO->getCpf()
        ]);
        if ($user instanceof User) {
            throw UserAlreadyExistsException::userFound($userDTO->getCpf());
        }

        $user = User::make($userDTO);
        $password = $this->userPasswordEncoder->encodePassword($user, $userDTO->getPassword());
        $user->setPassword($password);

        $this->userRepository->beginTransaction();
        try {
            $this->userRepository->persist($user);
        } catch (\Exception $exception) {
            $this->userRepository->rollBack();
            throw $exception;
        }
        $this->userRepository->commit();

        return $user->jsonSerialize();
    }
}

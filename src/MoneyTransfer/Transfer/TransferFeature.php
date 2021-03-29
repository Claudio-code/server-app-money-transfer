<?php

namespace App\MoneyTransfer\Transfer;

use App\Controller\MoneyTransfer\MoneyTransferDTO;
use App\MoneyTransfer\Transfer\UserReceivingMoney\UserReceivingMoneyService;
use App\MoneyTransfer\Transfer\UserTransferMoney\UserTransferMoneyService;
use App\MoneyTransfer\User\UserRepository;

class TransferFeature
{
    private UserRepository $userRepository;
    private UserTransferMoneyService $userTransferMoneyService;
    private UserReceivingMoneyService $userReceivingMoneyService;

    public function __construct(
        UserRepository $userRepository,
        UserTransferMoneyService $userTransferMoneyService,
        UserReceivingMoneyService $userReceivingMoneyService,
    ) {
        $this->userRepository = $userRepository;
        $this->userTransferMoneyService = $userTransferMoneyService;
        $this->userReceivingMoneyService = $userReceivingMoneyService;
    }

    public function compareCpf(MoneyTransferDTO $moneyTransferDTO): void
    {
        if ($moneyTransferDTO->getUserReceivingMoney() === $moneyTransferDTO->getUserSendingMoney()) {
            throw new UserTransferAndUserRecivingSameCpfException('O cpf do usuario que esta mandando e recebendo é o mesmo.');
        }
    }

    public function execute(MoneyTransferDTO $moneyTransferDTO): void
    {
        $this->compareCpf($moneyTransferDTO);
        $userSendingMoney = $this->userRepository->findUserByCpf(
            $moneyTransferDTO->getUserSendingMoney()
        );
        $userReceivingMoney = $this->userRepository->findByCpf(
            $moneyTransferDTO->getUserReceivingMoney()
        );

        $this->userRepository->beginTransaction();
        try {
            $this->userRepository->lock($userSendingMoney);
            $this->userRepository->lock($userReceivingMoney);

            $this->userTransferMoneyService->execute(
                $userSendingMoney,
                $moneyTransferDTO->getMoney()
            );
            $this->userReceivingMoneyService->execute(
                $userReceivingMoney,
                $moneyTransferDTO->getMoney()
            );

            $this->userRepository->persist($userReceivingMoney);
            $this->userRepository->persist($userSendingMoney);
        } catch (\Exception $exception) {
            $this->userRepository->rollBack();
            throw $exception;
        }
        $this->userRepository->commit();
    }
}

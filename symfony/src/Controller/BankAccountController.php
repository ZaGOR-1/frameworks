<?php

namespace App\Controller;

use App\Entity\BankAccount;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1')]
final class BankAccountController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager) {}

    #[Route('/bank-accounts', name: 'get_bank_accounts', methods: [Request::METHOD_GET])]
    public function getBankAccounts(): JsonResponse
    {
        $accounts = $this->entityManager->getRepository(BankAccount::class)->findAll();

        return new JsonResponse(['data' => $accounts], Response::HTTP_OK);
    }

    #[Route('/bank-accounts/{id}', name: 'get_bank_account_item', methods: [Request::METHOD_GET])]
    public function getBankAccountItem(string $id): JsonResponse
    {
        $account = $this->entityManager->getRepository(BankAccount::class)->find($id);

        if (!$account) {
            return new JsonResponse([
                'data' => ['error' => 'Not found bank account by id ' . $id]
            ], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(['data' => $account], Response::HTTP_OK);
    }

    #[Route('/bank-accounts', name: 'post_bank_accounts', methods: [Request::METHOD_POST])]
    public function createBankAccount(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);

        if (!is_array($requestData)) {
            return new JsonResponse([
                'data' => ['error' => 'Invalid JSON data']
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!isset($requestData['owner_name'], $requestData['account_number'])) {
            return new JsonResponse([
                'data' => ['error' => 'owner_name and account_number are required']
            ], Response::HTTP_BAD_REQUEST);
        }

        $account = new BankAccount();
        $account
            ->setOwnerName($requestData['owner_name'])
            ->setAccountNumber($requestData['account_number'])
            ->setBalance((string)($requestData['balance'] ?? '0.00'))
            ->setCurrency($requestData['currency'] ?? 'UAH')
            ->setIsActive($requestData['is_active'] ?? true);

        $this->entityManager->persist($account);
        $this->entityManager->flush();

        return new JsonResponse(['data' => $account], Response::HTTP_CREATED);
    }

    #[Route('/bank-accounts/{id}', name: 'patch_bank_accounts', methods: [Request::METHOD_PATCH])]
    public function updateBankAccount(string $id, Request $request): JsonResponse
    {
        $account = $this->entityManager->getRepository(BankAccount::class)->find($id);

        if (!$account) {
            return new JsonResponse([
                'data' => ['error' => 'Not found bank account by id ' . $id]
            ], Response::HTTP_NOT_FOUND);
        }

        $requestData = json_decode($request->getContent(), true);

        if (!is_array($requestData)) {
            return new JsonResponse([
                'data' => ['error' => 'Invalid JSON data']
            ], Response::HTTP_BAD_REQUEST);
        }

        if (array_key_exists('owner_name', $requestData)) {
            $account->setOwnerName($requestData['owner_name']);
        }

        if (array_key_exists('account_number', $requestData)) {
            $account->setAccountNumber($requestData['account_number']);
        }

        if (array_key_exists('balance', $requestData)) {
            $account->setBalance((string)$requestData['balance']);
        }

        if (array_key_exists('currency', $requestData)) {
            $account->setCurrency($requestData['currency']);
        }

        if (array_key_exists('is_active', $requestData)) {
            $account->setIsActive((bool)$requestData['is_active']);
        }

        $this->entityManager->flush();

        return new JsonResponse(['data' => $account], Response::HTTP_OK);
    }

    #[Route('/bank-accounts/{id}', name: 'delete_bank_accounts', methods: [Request::METHOD_DELETE])]
    public function deleteBankAccount(string $id): JsonResponse
    {
        $account = $this->entityManager->getRepository(BankAccount::class)->find($id);

        if (!$account) {
            return new JsonResponse([
                'data' => ['error' => 'Not found bank account by id ' . $id]
            ], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($account);
        $this->entityManager->flush();

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}

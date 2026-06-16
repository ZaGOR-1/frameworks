<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use function response;

class BankAccountController extends Controller
{
    public function getBankAccounts(): mixed
    {
        $accounts = BankAccount::all();

        return response()->json(['data' => $accounts], Response::HTTP_OK);
    }

    public function getBankAccountItem(string $id): mixed
    {
        $account = BankAccount::find($id);

        if (!$account) {
            return response()->json([
                'data' => ['error' => 'Not found bank account by id ' . $id]
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['data' => $account], Response::HTTP_OK);
    }

    public function createBankAccount(Request $request): mixed
    {
        $requestData = json_decode($request->getContent(), true);

        if (!is_array($requestData)) {
            return response()->json([
                'data' => ['error' => 'Invalid JSON data']
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!isset($requestData['owner_name'], $requestData['account_number'])) {
            return response()->json([
                'data' => ['error' => 'owner_name and account_number are required']
            ], Response::HTTP_BAD_REQUEST);
        }

        $account = BankAccount::create([
            'owner_name' => $requestData['owner_name'],
            'account_number' => $requestData['account_number'],
            'balance' => $requestData['balance'] ?? 0,
            'currency' => $requestData['currency'] ?? 'UAH',
            'is_active' => $requestData['is_active'] ?? true,
        ]);

        return response()->json(['data' => $account], Response::HTTP_CREATED);
    }

    public function updateBankAccount(string $id, Request $request): mixed
    {
        $account = BankAccount::find($id);

        if (!$account) {
            return response()->json([
                'data' => ['error' => 'Not found bank account by id ' . $id]
            ], Response::HTTP_NOT_FOUND);
        }

        $requestData = json_decode($request->getContent(), true);

        if (!is_array($requestData)) {
            return response()->json([
                'data' => ['error' => 'Invalid JSON data']
            ], Response::HTTP_BAD_REQUEST);
        }

        $account->update([
            'owner_name' => $requestData['owner_name'] ?? $account->owner_name,
            'account_number' => $requestData['account_number'] ?? $account->account_number,
            'balance' => $requestData['balance'] ?? $account->balance,
            'currency' => $requestData['currency'] ?? $account->currency,
            'is_active' => $requestData['is_active'] ?? $account->is_active,
        ]);

        return response()->json(['data' => $account], Response::HTTP_OK);
    }

    public function deleteBankAccount(string $id): mixed
    {
        $account = BankAccount::find($id);

        if (!$account) {
            return response()->json([
                'data' => ['error' => 'Not found bank account by id ' . $id]
            ], Response::HTTP_NOT_FOUND);
        }

        $account->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}

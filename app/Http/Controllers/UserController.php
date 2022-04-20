<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function updateItemsPerPage(Request $request): JsonResponse
    {
        $user = $this->model->findOrFail(auth()->id());
        $newNumber = $request->newNumber;
        
        $user->itemsPerPage = $newNumber;
        $user->save();

        return response()->json([
            'message' => 'Número de páginas alterado com sucesso!'
        ], 201);
    }

}

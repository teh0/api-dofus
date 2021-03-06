<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Monster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeederController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function seedMonsters(Request $request): \Illuminate\Http\JsonResponse
    {
        $monsterData = $request->input('data_monster');

        DB::table((new Monster())->getTable())->insert($monsterData);

        return response()->json([
            'type' => 'success'
        ]);
    }
}

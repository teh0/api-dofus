<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Monster;
use Illuminate\Http\Request;

class MonsterController extends Controller
{
    public function index(Request $request)
    {
        $monsters = Monster::query();

        if ($request->has('type')) {
            $monsters->where('type', '=', $request->input('type'));
        }
        if ($request->has('sort')) {
            $monsters->orderBy($request->input('sort'), $request->input('sort_direction', 'asc'));
        }
        if ($request->has('name')) {
            $monsters->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        if ($request->has('per_page')) {
            $monsters->paginate($request->input('per_page'));
        }

        $monsters = $request->has('per_page')
            ? $monsters->paginate($request->input('per_page'))
            : $monsters->get();

        return response()->json($monsters);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
// use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\EloquentDataTable;


class UserController extends Controller
{
    public function fetchUser () : JsonResponse
    {
        $user = User::orderBy('id', 'desc')->cursorPaginate(10);

        return response()->json([
            'data' => $user->items(),
            'next_cursor' => $user->nextPageUrl(),
        ]);
    }

    public function getData ()
    {
        $model = User::query();
        // return DataTables::of(User::query())->make(true);
        // return DataTables::of(User::query())->toJson();
        // return DataTables::eloquent($model)->toJson();
        // return $dataTables->eloquent($model)->toJson();
        return (new EloquentDataTable($model))->toJson();
    }

    public function user () : View
    {
        return view('user-infinite-scroll');
    }

    public function userTable () : View
    {
        return view('user-table-infinite-scroll');
    }

    public function userYajraDatatable ()
    {
        return view('user-yajra-datatable');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
// use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

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

    public function getData (Request $request)
    {
        $model = User::query()->latest();
        return $this->createDatatable($model, $request);
    }

    private function createDatatable ($model, Request $request) : JsonResponse
    {
        return (new EloquentDataTable($model))
            // * create id
            ->setRowId(function ($user) {
                return "data-$user->id";
            })
            // * create class
            ->setRowClass(function ($user) {
                return $user->id % 2 == 0 ? 'text-success' : 'text-primary';
            })
            // * sama membuat atribute tapi tidak langsun muncul di html tapi tidak terlalu cocok dibua jadi attribute
            ->setRowData([
                'data-url-find' => function($user) {
                    return route('get.user.id', $user->id);
                },
                'data-name' => function($user) {
                    return 'row-' . $user->name;
                },
            ])
            // * sama membuat atttribute tapi langsung muncul di html
            ->setRowAttr([
                'color' => function($user) {
                    return $user->name;
                },
                'style' => 'text-align: left;',
            ])
            // * create number
            ->addIndexColumn()
            ->addColumn('intro', function(User $user) {
                return "Hi $user->name!";
            })
            ->editColumn('name', function(User $user) {
                return "Hi $user->name!";
            })
            // * edit
            ->editColumn('created_at', function(User $user) {
                return $user->created_at->diffForHumans();
            })
            // * add column and use  view blade
            ->addColumn('centang', 'datatables.user.checkbox')
            // * add column and use view blade
            ->addColumn('action', 'datatables.user.action')
            // * allow column not XSS security
            ->rawColumns(['action', 'centang'])
            ->filter(function ($query) use ($request) {
                if ($request->has('month')) {
                    $query->whereMonth('created_at', '=', $request->input('month'));
                }
                if ($request->has('year')) {
                    $query->whereYear('created_at', '=', $request->input('year'));
                }
            }, true)
            ->toJson();
    }

    public function store(Request $request) : JsonResponse
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create($request->all());

        return response()->json([
            'message'   => 'User Berhasil Ditambahkan',
            'data'      => $user,
        ], 201);
    }

    public function show ($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $user
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    }

    public function update (Request $request, $id)
    {
        Log::info($request->all());

        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password'  => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::findOrFail($id);

        // Only include validated fields
        $userData = $request->only(['name', 'email']);

        // Only update password if it's provided
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return response()->json([
            'message'   => 'User Berhasil Diupdate',
            'data'      => $user,
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'User Berhasil Dihapus'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    }

    public function user() : View
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

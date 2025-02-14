<?php

namespace App\Http\Controllers;

use App\enum\RolesEnum;
use App\Http\Resources\AuthUserResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log as FacadesLog;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('id', '!=', Auth::id())->latest()->paginate(10);
        return Inertia::render('User/Index', [
           'users'=> AuthUserResource::collection($user),
        ]);
    }
    public function edit(User $user)
    {
        return Inertia::render('User/Edit', [
            'user' => new UserResource($user),
            'roles' => Role::all(),
            'roleLabels'=>RolesEnum::labels()
        ]);
    }
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'roles' => ['required', 'array'],
        ]);
        $user->syncRoles($data['roles']);
        return redirect()->route('user.index');

    }

}


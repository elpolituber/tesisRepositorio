<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Authentication\Permission;
use App\Models\Ignug\Catalogue;
use App\Models\Ignug\State;
use App\Models\Authentication\User;
use App\Models\Authentication\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class  AuthController extends Controller
{

    public function index(Request $request)
    {
        $state = State::where('code', '1')->first();
        $users = $state->users()
            ->with('ethnicOrigin')
            ->with('location')
            ->with('identificationType')
            ->with('sex')
            ->with('gender')
            ->get();
        return response()->json([
            'data' => [
                'users' => $users
            ]
        ], 200);

    }

    public function getPermissions(Request $request)
    {
        $role = Role::where('code',$request->role)->first();
        $permissions = $role->permissions()
            ->with(['routes' => function ($query) {
                $query->with('children');
            }])
            ->get();
        return $permissions;
    }

    public function getUser(Request $request)
    {
        $user = User::with('ethnicOrigin')
            ->with('location')
            ->with('identificationType')
            ->with('sex')
            ->with('gender')
            ->with('state')
            ->with('images')
            ->with(['roles' => function ($query) use ($request) {
                $query->with('system')
                    ->with(['permissions' => function ($query) {
                        $query->with(['route' => function ($query) {
                            $query->with('module');
                        }]);
                    }])->where('code', $request->role);
            }])
            ->where('username', $request->username)
            ->first();
//        $user = $user->with('ethnicOrigin')
//            ->with('location')
//            ->with('identificationType')
//            ->with('sex')
//            ->with('gender')
//            ->with('state')
//            ->with(['roles' => function ($query) {
//                $query->with('system')
//                    ->with(['permissions' => function ($query) {
//                        $query->with(['route'=>function($query){
//                            $query->with('module');
//                        }]);
//                    }]);
//            }])
//            ->first();
        $allPermissions = Permission::with('route')->get();
        return response()->json([
            'data' => [
                'user' => $user,
                'permissions' => $allPermissions,
            ]
        ], 200);

    }

    public function login(Request $request)
    {
        $request->validate([
            'system' => 'required|integer',
            'username' => 'required|string',
            'password' => 'required|string',

        ]);
        $system = Catalogue::findOrFail($request->system);

        $user = User::where('username', $request->username)->with('state')->first();

        // Se valida que el usuario exista
        if (!$user) {
            return response()->json([
                'error' => [
                    'title' => 'not found',
                    'detail' => 'user not found'
                ]
            ], 404);
        }

        // Se valida que el usuario y contraseña son correctos
        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return response()->json([
                'error' => [
                    'title' => 'unauthorized',
                    'detail' => 'user unauthorized'
                ]
            ], 401);
        }

        // Se valida que el rol y sistema al cual quiere ingresar, esten asiganados correctamente

        if ($system) {
            $roles = $user->roles()->get();
            $permissions = null;
            $flagRole = false;

            foreach ($roles as $role) {
                if ($role['system_id'] == $system['id']) {
                    $permissions = $role->permissions()->with('route')->get();
                    $flagRole = true;
                }
            }

            if (!$flagRole) {
                return response()->json([
                    'error' => [
                        'title' => 'forbidden',
                        'detail' => 'system forbidden'
                    ]
                ], 403);
            }
        } else {
            return response()->json([
                'error' => [
                    'title' => 'not found',
                    'detail' => 'system not found'
                ]
            ], 404);
        }

        $accessToken = Auth::user()->createToken('authToken');

        if ($request->remember_me) {
            $accessToken->token->expires_at = Carbon::now()->addMonth(1);
        }
        $allPermissions = Permission::all();
        return response()->json([
            'auth' => [
                'user' => $user,
                'roles' => $roles,
                'permissions' => $permissions,
                'token' => $accessToken],
            'permissions' => $allPermissions,
        ], 201);
    }

    public function logout(Request $request)
    {
        DB::table('oauth_access_tokens')
            ->where('user_id', $request->user_id)
            ->update([
                'revoked' => true
            ]);
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function store(Request $request)
    {
        $data = $request->json()->all();
        $dataUser = $data['user'];
        $user = new User();

        $user->identification = strtoupper(trim($dataUser['identification']));
        $user->username = trim($dataUser['username']);
        $user->first_name = strtoupper(trim($dataUser['first_name']));
        $user->first_lastname = strtoupper(trim($dataUser['first_lastname']));
        $user->birthdate = trim($dataUser['birthdate']);
        $user->email = strtolower(trim($dataUser['email']));
        $user->password = Hash::make(trim($dataUser['password']));

        $ethnicOrigin = Catalogue::findOrFail($dataUser['ethnic_origin']['id']);
        $location = Catalogue::findOrFail($dataUser['location']['id']);
        $identificationType = Catalogue::findOrFail($dataUser['identification_type']['id']);
        $sex = Catalogue::findOrFail($dataUser['sex']['id']);
        $gender = Catalogue::findOrFail($dataUser['gender']['id']);
        $state = Catalogue::where('code', '1')->first();
        $user->ethnicOrigin()->associate($ethnicOrigin);
        $user->location()->associate($location);
        $user->identificationType()->associate($identificationType);
        $user->sex()->associate($sex);
        $user->gender()->associate($gender);
        $user->state()->associate($state);
        $user->save();
        return response()->json(['message' => 'Usuario creado', 'user' => $user], 201);
    }

    public function update(Request $request)
    {
        $data = $request->json()->all();
        $dataUser = $data['user'];
        $user = User::findOrFail($dataUser['id']);
        $user->identification = $dataUser['identification'];
        $user->username = strtoupper(trim($dataUser['username']));
        $user->first_name = strtoupper(trim($dataUser['first_name']));
        $user->first_lastname = strtoupper(trim($dataUser['first_lastname']));
        $user->birthdate = trim($dataUser['birthdate']);
        $user->email = strtolower(trim($dataUser['email']));

        $ethnicOrigin = Catalogue::findOrFail($dataUser['ethnic_origin']['id']);
        $location = Catalogue::findOrFail($dataUser['location']['id']);
        $identificationType = Catalogue::findOrFail($dataUser['identification_type']['id']);
        $sex = Catalogue::findOrFail($dataUser['sex']['id']);
        $gender = Catalogue::findOrFail($dataUser['gender']['id']);
        $state = Catalogue::where('code', '1')->first();
        $user->ethnicOrigin()->associate($ethnicOrigin);
        $user->location()->associate($location);
        $user->identificationType()->associate($identificationType);
        $user->sex()->associate($sex);
        $user->gender()->associate($gender);
        $user->state()->associate($state);
        $user->save();
        return response()->json(['message' => 'Usuario actualizado', 'user' => $user], 201);
    }

    public function destroy($id)
    {
        $state = Catalogue::where('code', '3')->first();
        $user = User::findOrFail($id);
        $user->state()->associate($state);
        $user->save();
        return response()->json(['message' => 'Usuario eliminado', 'user' => $user], 201);
    }

    public function changePassword(Request $request)
    {
        $data = $request->json()->all();
        $dataUser = $data['user'];
        $user = User::findOrFail($dataUser['id']);
        $user->update([
            'password' => Hash::make(trim($dataUser['password'])),
        ]);
        return response()->json(['message' => 'Usuario actualizado', 'user' => $user], 201);
    }

    public function uploadAvatarUri(Request $request)
    {
        if ($request->file('file_avatar')) {
            $user = User::findOrFail($request->user_id);
            Storage::delete($user->avatar);
            $pathFile = $request->file('file_avatar')->storeAs('private/avatar',
                $user->id . '.png');
//            $path = storage_path() . '/app/' . $pathFile;
            $user->update(['avatar' => $pathFile]);
            return response()->json(['message' => 'Archivo subido correctamente'], 201);
        } else {
            return response()->json(['errores' => 'Archivo no válido'], 500);
        }

    }
}

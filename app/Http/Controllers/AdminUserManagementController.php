<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use jeremykenedy\LaravelRoles\Models\Role;

class AdminUserManagementController extends Controller
{
    
    private function imageUploader($image): string
    {
        $uploadedFileUrl = Cloudinary()->upload($image)->getSecurePath();
        return $uploadedFileUrl;
    }

    public function getProfile()
    {
        return view("agent.profile");
    }

    public function getAdminProfile()
    {
        return view("admin.profile");
    }

    public function users()
    {
        $auth = auth()->user();
        return view("admin.users.index", compact("auth"));
    }

    public function agents()
    {
        $auth = auth()->user();
        return view("admin.users.agents.index", compact("auth"));
    }
    
    public function index(Request $request)
    {
        if($request->role == "all"){
            return response(UserResource::collection(User::latest()->where("active", 1)->get()));
        }elseif($request->role == "agent"){
            $agent = Role::where("slug", "agent")->first()->users->where("active", 1);
            return response(UserResource::collection($agent));
        }
        else{
            $user = Role::where("slug", $request->role)->first()->users->where("active", 1);
            return response(UserResource::collection($user));
        }
    }

    public function store(Request $request)

    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'role_id' => "required"
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make('password'),
        ]);
        $role = Role::find($request['role_id']);
        $user->attachRole($role);
        return response(new UserResource($user));
    }


    public function show(User $user)
    {
        return $user;
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => ['required', 'string', 'max:255', 'unique:users,email,' . $user->id],
            "role_id" => "required"
        ]);
        $user->update([
            'email' => $request['email'],
        ]);
        $user->detachAllRoles();
        $role = Role::find($request['role_id']);
        $user->attachRole($role);
        return response(new UserResource($user));
    }
    // verfiying the user
    public function verify(Request $request, User $user)
    {
        $user->update(["verified" => $request->verified]);
        return response(new UserResource($user));
    }

    public function destroy(User $user)
    {
        $user->detachAllRoles();
        $user->delete();
    }

    public function profile(Request $request, User $user)
    {
        $validators = validator()->make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => 'required|regex:/^(07[8,2,3,9])[0-9]{7}$/|unique:users',
        ]);
        if ($validators->fails()) {
            return response()->json($validators->errors(), 422);
        }
        if ($request->old_password && trim($request->old_password) != "") {

            $old_password = $user->getAuthPassword();
            if (password_verify($request->old_password, $old_password)) {
                $validators = validator()->make($request->all(), [
                    "password" => "required|confirmed"
                ]);
                if ($validators->fails()) {
                    return response()->json($validators->errors(), 422);
                }
                $user->update(["password" => Hash::make($request->password)]);
            } else {
                return response()->json(["old_password" => "Wrong Password"], 400);

            }
        }
        if ($request["avatar"] !== $user->avatar) {
            $request["avatar"] = $this->imageUploader($request->avatar);
        }
        $user->update(["country" => $request->country, "avatar" => $request->avatar, "email" => $request->email, "phone_number" => $request->phone_number]);


        return $user;

    }

    public function details()
    {
        return User::where("id", auth()->user()->id)->first();
    }
}

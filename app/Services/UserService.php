<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class UserService
{
    public function getAllUsers()
    {
        return User::query()->paginate(15);
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function createUser ( array $data)
    {
        $validator=Validator::make($data,[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'bio'=>'nullable|string',
            'imageUrl'=>'nullable|string',
            'coverImageUrl' => 'nullable|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $validated = $validator->validate();
        return User::create($validated);
    }


    public function updateUser ($id, array $data)
    {
        $user=User::findOrFail($id);
        $validator=Validator::make($data,[
            'name' => 'sometimes|required|string|max:255',
            'bio' => 'sometimes|nullable|string',
            'coverImageUrl'=>'sometimes|nullable|string',
            'imageUrl'=>'sometimes|nullable|string',
        ]);
        $validated = $validator->validate();
        $user->update($validated);
        return $user;
        
    }


    public function deleteUser($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return true;
    }
}
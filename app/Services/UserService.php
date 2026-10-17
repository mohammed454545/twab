<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class UserService
{
    public function getAllUsers(array $filters)
    {
        $perPage = $filters['per_page'] ?? 15;
        return User::query()->paginate($perPage);
    }

    public function getAllUsersList()
    {
        return User::select('id', 'name')->get();
    }
    
    public function getUserById(int $id)
    {
        return User::findOrFail($id);
    }

    public function createUser ( array $data)
    {
        return User::create($data);
    }


    public function updateUser (int $id, array $data)
    {
        $user=User::findOrFail($id);
        $user->update($data);
        return $user;
        
    }


    public function deleteUser(int $id)
    {
        $user=User::findOrFail($id);
        $user->delete();
    }
}
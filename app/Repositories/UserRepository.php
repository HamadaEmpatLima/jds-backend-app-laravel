<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        return User::all();
    }

    public function findById($id)
    {
        return User::find($id);
    }

    public function create(array $formData)
    {
        return User::create($formData);
    }

    public function update($id, array $formData)
    {
        $user = User::find($id);
        $user->update($formData);
        $user->save();
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return $user;
    }
}

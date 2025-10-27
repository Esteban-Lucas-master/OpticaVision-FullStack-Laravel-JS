<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * Update user role
     *
     * @param User $user
     * @param string $role
     * @return bool
     */
    public function updateUserRole(User $user, string $role)
    {
        if (!in_array($role, ['cliente', 'vendedor', 'admin'])) {
            return false;
        }

        $user->rol = $role;
        return $user->save();
    }

    /**
     * Get all users
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * Find user by ID
     *
     * @param int $id
     * @return User|null
     */
    public function findUserById(int $id)
    {
        return User::find($id);
    }

    /**
     * Check if user has admin role
     *
     * @param User $user
     * @return bool
     */
    public function isAdmin(User $user)
    {
        return $user->rol === 'admin';
    }

    /**
     * Check if user has seller role
     *
     * @param User $user
     * @return bool
     */
    public function isSeller(User $user)
    {
        return $user->rol === 'vendedor';
    }

    /**
     * Check if user has client role
     *
     * @param User $user
     * @return bool
     */
    public function isClient(User $user)
    {
        return $user->rol === 'cliente';
    }
}
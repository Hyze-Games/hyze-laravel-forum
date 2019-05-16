<?php

namespace App\Policies;

use App\Models\Chatter\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization, RestrictablePolice;

    public function read(?User $user, Category $category)
    {
        return $this->can($user, 'read', 'category', $category, true);
    }

    public function write(?User $user, Category $category)
    {
        return $this->can($user, 'write', 'category', $category, true);
    }
}
<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\User;

class CategoryObserver
{
    public function creating(Category $category)
    {
        if (($user = request()->user()) instanceof User) {
            $category->user_id = $user->id;
        }
    }
}

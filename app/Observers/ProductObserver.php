<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\User;

class ProductObserver
{
    public function creating(Product $product)
    {
        if (($user = request()->user()) instanceof User) {
            $product->user_id = $user->id;
        }
    }
}

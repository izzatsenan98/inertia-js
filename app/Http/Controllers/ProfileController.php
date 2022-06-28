<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function showUserForm(Request $request)
    {
        return Inertia::render('Profile/Show', [
            'user' => $request->user(),
        ]);
    }

    public function updateUser(UserRequest $request)
    {
        $request->user()->update($request->validated());

        return back()->with('message', 'User profile updated successfully.');
    }

    public function showPasswordForm()
    {
        return Inertia::render('Profile/Password');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $request->user()->update($request->validated());

        return back()->with('message', __('The password has been updated.'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfile as UserProfileRequest;
use App\Service\User as UserService;
use App\Models\User;
use Illuminate\Support\Facades\Auth as AuthManager;

class UserProfile
    extends Controller
{
    protected ?UserService $userService = null;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function edit()
    {
        return view(
            'userProfile.edit',
            ['loggedUser' => AuthManager::user()]
        );
    }

    public function update(UserProfileRequest $request)
    {
        $userData = $request->validated();

        $user = $this
            ->userService
            ->update(
                AuthManager::user(),
                $userData
            );

        if (!is_null($user)) {
            $request
                ->session()
                ->flash(
                    'flash',
                    [
                        'type' => 'success',
                        'message' => 'User profile edited successfully.',
                    ]
                );

            return redirect()->back();
        }
    }
}

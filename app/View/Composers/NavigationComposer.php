<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth as AuthManager;


class NavigationComposer
{

    protected $availableNavigationItems = [
        [
            'title' => 'All Books',
            'route' => 'book.index',
            'permission' => 'book.show'
        ],
        [
            'title' => 'Create Book',
            'route' => 'book.create',
            'permission' => 'book.store'
        ],
        [
            'title' => 'Show favourites',
            'route' => 'my_books',
            'permission' => false
        ]
    ];

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        /**
         * @var \App\Models\User $loggedUser
         */
        $loggedUser = AuthManager::user();
        $navigationItems = [];

        if (!is_null($loggedUser)) {
            $navigationItems = array_filter(
                $this->availableNavigationItems,
                fn($ani, $iani) => $ani['permission'] == false || $loggedUser->hasPermission($ani['permission']),
                ARRAY_FILTER_USE_BOTH
            );
        }

        $view->with(
            'navigationItems',
            $navigationItems
        );
    }
}

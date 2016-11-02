<?php
namespace App\Http\Routes\Backoffice;

use Digbang\Security\Contracts\SecurityApi;
use Digbang\Security\SecurityContext;
use Illuminate\Routing\Router;
use LaravelBA\RouteBinder\Bindings;

class UserBindings implements Bindings
{
    /**
     * {@inheritdoc}
     */
    public function addBindings(Router $router)
    {
        $router->bind('backoffice_user_id', function ($id) {
            /** @var SecurityApi $security */
            $security = app(SecurityContext::class)->getSecurity('backoffice');

            return $security->users()->findById($id) ?: abort(404);
        });

        $router->bind('backoffice_username', function ($username) {
            /** @var SecurityApi $security */
            $security = app(SecurityContext::class)->getSecurity('backoffice');

            return $security->users()->findByCredentials(['username' => $username]) ?: abort(404);
        });
    }
}

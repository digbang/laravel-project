<?php

namespace App\Http\Backoffice\Handlers\Auth;

use App\Http\Backoffice\Handlers\Handler;
use App\Http\Kernel;
use App\Http\Util\RouteDefiner;
use Digbang\Security\Contracts\SecurityApi;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Router;

class AuthLogoutHandler extends Handler implements RouteDefiner
{
    protected const ROUTE_NAME = 'backoffice.auth.logout';

    public function __invoke(SecurityApi $securityApi, Redirector $redirector)
    {
        $securityApi->logout();

        return $redirector->to(AuthLoginHandler::route());
    }

    public static function defineRoute(Router $router)
    {
        $router
            ->get(config('backoffice.global_url_prefix') . '/auth/logout', static::class)
            ->name(static::ROUTE_NAME)
            ->middleware([
                Kernel::WEB,
                Kernel::BACKOFFICE,
            ]);
    }

    public static function route()
    {
        return route(static::ROUTE_NAME);
    }
}

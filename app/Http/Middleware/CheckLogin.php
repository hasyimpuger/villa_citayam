<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()){
            $menu = array_slice(func_get_args(), 2);
            if(!in_array("dashboard", $menu)){
                $listMenus = config("app.list_accessible_menus");
                $listUsergroups = config("app.list_user_groups");
                $intersect = array_intersect($menu, $listMenus);
                if(!in_array("Superadmin", $listUsergroups) && count($intersect) == 0){
                    abort('403');
                }
            }
            return $next($request);

        } else {
            return redirect('/');
        }

    }
}

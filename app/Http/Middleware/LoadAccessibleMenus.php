<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class LoadAccessibleMenus
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
        if(Auth::check()){
            $listMenus = [];
            $listGroups = [];

            $user = Auth::user();

            $listGroupIds = [];
            foreach($user->usergroups as $usergroup){
                $listGroups[] = $usergroup->name;
                $listGroupIds[] = $usergroup->id;
            }

            $data = DB::select("SELECT menus.menu_value FROM menus, menu_usergroup WHERE menus.deleted_at IS NULL AND menu_usergroup.deleted_at IS NULL AND menus.id = menu_usergroup.menu_id AND menu_usergroup.usergroup_id IN ('".implode("','", $listGroupIds)."');");
            foreach($data as $row){
                $listMenus[] = $row->menu_value;
            }

            $data = User::where('user_id', $user->id)->first();
            if($data){
                config(["app.user_id" => $data->id]);
            }else{
                config(["app.user_id" => ""]);
            }

            config(["app.list_accessible_menus" => $listMenus]);
            config(["app.list_user_groups" => $listGroups]);
        }
        return $next($request);
    }
}

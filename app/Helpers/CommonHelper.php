<?php

namespace App\Helpers;

class CommonHelper{

    public static function checkPermission($menu)
    {
        $output = true;
        $listMenus = config("app.list_accessible_menus");
        $listUsergroups = config("app.list_user_groups");
        if(!in_array("Superadmin", $listUsergroups) && !in_array($menu, $listMenus)){
            $output = false;
        }
        return $output;
    }
}
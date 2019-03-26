<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function Usergroups()
    {
        return $this->belongsToMany('App\Usergroup')->whereNull('menu_usergroup.deleted_at');
    }

}

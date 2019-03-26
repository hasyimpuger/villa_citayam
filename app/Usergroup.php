<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Usergroup extends Model
{
    use SoftDeletes;
    protected $table = 'usergroups';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}

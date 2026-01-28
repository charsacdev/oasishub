<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminTable extends Authenticatable
{
     use Notifiable;
     
     protected $table = 'admin_tables';

     protected $guarded = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetsTable extends Model
{
     protected $table = 'assets_tables';

     protected $guarded = [];

     protected $casts = [
        'asset_photos' => 'array',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carting extends Model
{
    protected $table = 'cartings';

    protected $guarded = [];

    public function product(){

       return $this->belongsTo(AssetsTable::class, 'asset_id');
     }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingTable extends Model
{
     protected $table = 'booking_tables';

     protected $guarded = [];

     public function asset(){

       return $this->belongsTo(AssetsTable::class, 'asset_id');
     }

     public function cart()
      {
          return $this->hasMany(Carting::class, 'cookie_id', 'cart_id');
      }

      
}

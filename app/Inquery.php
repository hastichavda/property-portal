<?php

namespace App;

use App\User;
use App\Property;
use Illuminate\Database\Eloquent\Model;

class Inquery extends Model
{
   protected $fillable = [
        'user_id',
        'property_id',
        'fname',
        'lname',
        'email',
        'contactno',
        'message'
   ];

     
   public function user()
   {
       return $this->hasMany('App\User');
   }

   public function property()
   {
       return $this->hasOne('App\Property');
   }
}

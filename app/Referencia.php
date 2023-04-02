<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    protected $table ='referencia';

    protected $fillable = [
        'nombre'
    ];

    public function anotaciones()
    {
        return $this->hasMany('App\Anotacion');
    }
}

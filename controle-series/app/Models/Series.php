<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    //podemos fazer inserções em massa no banco de dados
    //no entanto precisamos passar para o atributo fillable
    //quais são eles
    protected $fillable = ['name'];


    public function seasons(){
        return $this->hasMany(Seasons::class, 'series_id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Import_pokemon extends Model
{

    protected $table = 'import_pokemon';

    protected $fillable = [
        'idApi',
        'name',
        'height',
        'prop3',
        'weight',
        'thumbnail',
    ];

}

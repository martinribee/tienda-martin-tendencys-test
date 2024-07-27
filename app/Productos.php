<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'catalog_products';

    protected $primaryKey = 'id_product';

    public $timestamps = false;
    
    //Para edición masiva.
    protected $fillable = ['name', 'description', 'height', 'length', 'width'];
}

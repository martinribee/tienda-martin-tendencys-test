<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access_tokens extends Model
{
    protected $table = 'access_tokens';

    protected $primaryKey = 'id_access_tokens';

    public $timestamps = false;
    
    //Para edición masiva.
    protected $fillable = ['user_id','token'];
}

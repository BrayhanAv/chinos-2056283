<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class artista extends Model
{
    protected $table= "artists";
    protected $primaryKey = "ArtistId";
    public $timestamps = false;

    //extender nuestro modelo
    public function albumes(){
        return $this->hasMany('App\Album','ArtistId');
    }

}

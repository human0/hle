<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name','description','location','start','end',];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

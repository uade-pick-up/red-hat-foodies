<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	protected $table = 'blogs';

    protected $fillable = ['user_id', 'date', 'image', 'heading', 'detail', 'text', 'approved', 'status'];
     
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_categories';

    protected $fillable = [
    	'name', 'slug'
    ];

    public function category(){
    	return $this -> belongsTo('App\Category', 'category_id');
    }

    public function projects(){
    	return $this->morphMany('App\Project', 'projectable');
    }
}

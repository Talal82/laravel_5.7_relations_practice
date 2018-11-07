<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
    	'name', 'slug'
    ];

    public function subCategories(){
    	return $this -> hasMany('App\SubCategory', 'category_id');
    }

    public function projects(){
    	return $this->morphMany('App\Project', 'projectable');
    }
}

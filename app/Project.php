<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    	'name', 'detail', 'main_image', 'projectable_id', 'projectable_type',
    ];

    public function projectable()
    {
        return $this->morphTo();
    }
}

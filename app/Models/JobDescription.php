<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobDescription extends Model
{
    protected $fillable = [
        'name',
    ];    


    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionalOffice extends Model
{
    protected $fillable= [
        'name',
        'region',
        'country',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}

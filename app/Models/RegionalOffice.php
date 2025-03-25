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
        return $this->hasMany(Employee::class,'regoinal_office_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('country', 'like', '%' . $search . '%');
    }
}

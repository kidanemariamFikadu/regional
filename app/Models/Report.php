<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'regional_office_id',
        'user_id',
        'reporting_period',
        'submission_date'
    ];

    public function regionalOffice()
    {
        return $this->belongsTo(RegionalOffice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kpis()
    {
        return $this->hasMany(KPI::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function trainingPrograms()
    {
        return $this->hasMany(TrainingProgram::class);
    }

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }    
}

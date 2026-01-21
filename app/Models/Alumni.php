<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumnus';

    protected $fillable = [
        'tenant_id',
        'user_id',
        'batch_id',
        'department_id',
        'passing_year_id',
        'first_class_id',
        'final_class_id',
        'first_house_id',
        'final_house_id',
        'id_number',
        'company',
        'company_designation',
        'company_address',
        'file',
        'blood_group',
        'date_of_birth',
        'gender',
        'about_me',
        'linkedin_url',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'city',
        'state',
        'zip',
        'country',
        'address',
        // FGCO-specific fields
        'nickname',
        'state_of_origin',
        'lga_of_origin',
        'current_job',
        'expertise',
        'company_name',
        'work_address',
        'bio'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * First year class at FGCO
     */
    public function firstClass()
    {
        return $this->belongsTo(SchoolClass::class, 'first_class_id');
    }

    /**
     * Final year class at FGCO
     */
    public function finalClass()
    {
        return $this->belongsTo(SchoolClass::class, 'final_class_id');
    }

    /**
     * Initial house assignment
     */
    public function firstHouse()
    {
        return $this->belongsTo(House::class, 'first_house_id');
    }

    /**
     * Final house assignment
     */
    public function finalHouse()
    {
        return $this->belongsTo(House::class, 'final_house_id');
    }

    public function passingYear()
    {
        return $this->belongsTo(PassingYear::class, 'passing_year_id');
    }
}

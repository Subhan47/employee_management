<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'password', 'designation_id'];



    public function designation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    // get the searched item by using scope
    public function scopeGetBySearch($query,$search)
    {
        return $query->where(function ($query) use ($search) {
            $query->orWhere('id', $search)
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
                //->orWhere('designation', 'like', '%' . $search . '%');
        });
    }
}

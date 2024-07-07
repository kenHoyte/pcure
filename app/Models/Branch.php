<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_code',
        'branch_name'
    ];

    public function users(){
        return $this->hasMany(User::class)->where('branch', $this->branch_code)->get();
    }
    
    public function requests(){
        return $this->hasMany(Req::class)->where('branch', $this->branch_code)->get();
    }
}

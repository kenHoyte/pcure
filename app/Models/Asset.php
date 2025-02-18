<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'name',
        'location',
        'condition',
        'remark',
        'requester_id',
        'request_id',
        'dispose',
        'repair',
        'status'
    ];

    public function requester(){
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function uploads(){
        return $this->hasMany(Upload::class, 'asset_id');
    }
}
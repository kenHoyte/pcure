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
}
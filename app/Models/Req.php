<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Req extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'remark_1',
        'remark_2',
        'remark_3',
        'approver_id',
        'authorizer_id',
        'approved',
        'authorized',
        'location',
    ];
}
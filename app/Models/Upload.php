<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable =[
        'file_name',
        'file_type',
        'file_path',
        'user_id',
        'asset_id',
        'req_id',
        'remark'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
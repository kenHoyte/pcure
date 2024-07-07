<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Req extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'req_remark',
        'appr_remark',
        'auth_remark',
        'requester_id',
        'approver_id',
        'authorizer_id',
        'approved',
        'authorized',
        'location',
        'branch',
    ];

    public function requester(){
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function approver(){
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function authorizer(){
        return $this->belongsTo(User::class, 'authorizer_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class)->where('branch_code', $this->branch)->get();
    }


}
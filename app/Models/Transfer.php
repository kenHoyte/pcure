<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillables = ['asset_id', 'initiated_by', 'from_location', 'from_branch', 'to_location', 'to_branch',
    'within_branch', 'between_branches'
];

    public function asset(){
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function from_branch(){
        return $this->belongsTo(Branch::class)->where('branch_code', $this->from_branch)->get();
    }
    
    public function to_branch(){
        return $this->belongsTo(Branch::class)->where('branch_code', $this->to_branch)->get();
    }
}

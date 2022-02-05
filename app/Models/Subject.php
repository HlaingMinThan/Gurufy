<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class);
    }

    public function statusName()
    {
        if ($this->status==1) {
            return '<span class="text-success">Active</span>';
        }
        else{
            return '<span class="text-danger">Inactive</span>';
        }
    }

    public function createdAt()
    {
        return date('d M Y', strtotime($this->created_at));
    }
}

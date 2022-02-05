<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    use HasFactory;

    public function subjects()
    {
        return $this->hasMany(Subject::class);
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

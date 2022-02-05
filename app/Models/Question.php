<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function typeName()
    {
        if($this->question_type == 1){
            return 'MCQ';
        }elseif($this->question_type == 2){
            return 'Fill in the blank';
        }elseif($this->question_type == 3){
            return 'Matchine';
        }elseif($this->question_type == 4){
            return 'Formula rendering';
        }elseif($this->question_type == 5){
            return 'Arranging statement';
        }elseif($this->question_type == 6){
            return 'Descriptive';
        }

        return null;
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



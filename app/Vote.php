<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['candidate_id', 'voter_id'];

    public function voter()
    {
        return $this->belongsTo('App\User', 'voter_id');
    }

    public function candidate()
    {
        return $this->belongsTo('App\User', 'candidate_id');
    }
}

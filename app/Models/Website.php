<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $fillable=['user_id','short_url','long_url','total_clicks'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

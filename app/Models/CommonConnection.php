<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonConnection extends Model
{
    use HasFactory;
    protected $table = 'common_connections';

    protected $fillable = ['user1_id', 'user2_id', 'common_user_id'];

    public function first_user()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }
   
    public function second_user()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    public function common_user()
    {
        return $this->belongsTo(User::class, 'common_user_id');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotingUser extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'device_fingerprint', 'ip_address', 'user_agent'];
}

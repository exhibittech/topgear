<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikeVote extends Model
{
    use HasFactory;
    protected $fillable = ['voting_user_id', 'bcat1', 'bcat2', 'bcat3', 'bcat4', 'bcat5', 'bcat6', 'bcat7', 'bcat8', 'bcat9', 'bcat10', 'bcat11', 'bcat12', 'bcat13', 'bcat14', 'bcat15', 'bcat16', 'bcat17', 'bcat18', 'bcat19', 'bcat20'];

}

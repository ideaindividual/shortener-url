<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    use HasFactory;

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'authentication_api';
        
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'api_key', 'user_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Jenssegers\Mongodb\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'profiles';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name','age','mobile','last_login_ip','lat','lng'
    ];

    protected $guarded = [
        'id','created_at','updated_at'
    ];

}

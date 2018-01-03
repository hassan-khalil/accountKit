<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fb_id', 'phone',
    ];
 

   /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'access_token', 'remember_token',
    ];


    /** 
     *  Set value of access_token
     *
     *  @param string $accessToken
     *  @return App/User
     */
    public function setAccessToken($accessToken){
        $this->access_token = $accessToken;
        return $this;
    }
}

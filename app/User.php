<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $appends = ['avatar_url'];

    public function getAvatarUrlAttribute()
    {
        return Storage::url('avatars/'.$this->id.'/'.$this->avatar);
    }

    protected $fillable = [
        'name', 'email', 'password', 'active', 'activation_token', 'avatar'
    ];
    protected $hidden = [
        'password', 'remember_token', 'activation_token'
    ];
}

<?php

namespace App\Entities;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public    $timestamps   = true;
    protected $table        = 'app_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable  = [
        'cpf', 
        'name', 
        'phone', 
        'birth', 
        'gender', 
        'notes', 
        'email', 
        'password', 
        'status', 
        'permission',
        'departament_id',
        'office_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setPasswordAttribute($value) 
    {
        $this->attributes['password'] = env('PASSWORD_HASH') ? bcrypt($value) : $value;
    }

    public function getCpfAttribute(){

        $cpf= $this->attributes['cpf'];
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 7, 3) . '-' . substr($cpf, -2);

    }

    public function getPhoneAttribute()
	{
		$phone = $this->attributes['phone'];
		return "(" . substr($phone, 0, 2) . ") " . substr($phone, 2, 4) . "-" . substr($phone, -4);
	}

	public function getBirthAttribute()
	{
		$birth = explode('-', $this->attributes['birth']);
		
		if(count( (array) $birth) != 3)
			return "";

		$birth = $birth[2] . '/' . $birth[1] . '/' . $birth[0];
		return $birth;
	}
}

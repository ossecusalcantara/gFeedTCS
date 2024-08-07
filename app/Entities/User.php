<?php

namespace App\Entities;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;


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
        'profile_picture',
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

    protected $appends = [
        'formatted_cpf',
        'formatted_phone',
        'formatted_gender',
        'formatted_birth',
    ];

    
    public function departament(): BelongsTo 
    {
        return $this->belongsTo(Departament::class, 'departament_id');
    }
    
    public function office(): BelongsTo 
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
    
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function assignPermission(string $permission): void
    {

        $permission = $this->permissions()->firstOrCreate([
            'name' => $permission,
        ]);

        $this->permissions()->attach($permission);
    }

    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->where('name', $permission)->exists();
    }

    public function setCpfAttribute($value) 
    {
        $this->attributes['cpf'] =  preg_replace('/[^0-9]/', '', $value);
    }

    public function setPhoneAttribute($value) 
    {
        $this->attributes['phone'] =  preg_replace('/[^0-9]/', '', $value);
    }

    protected function formattedCpf() : Attribute
    {
        return Attribute::make(
            get:fn () => formatCnpjCpf($this->cpf)
        );

    }

    protected function formattedPhone() : Attribute
    {
        return Attribute::make(
            get:fn () => formatPhone($this->phone)
        );
    }

    protected function formattedBirth() : Attribute
    {
        return Attribute::make(
            get:fn () => formatData($this->birth)
        );
    }

    protected function formattedGender() : Attribute
    {
        return Attribute::make(
            get:fn () => formatGender($this->gender)
        );
    }

}

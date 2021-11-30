<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 *
 * @property int $id
 * @property int $professional_council_id
 * @property string $professional_council_number
 * @property string $name
 * @property string $email
 * @property Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var array
     */
    public static $update_password_rules = [
        'current_password' => 'required|password:api',
        'password' => 'required|confirmed|min:6',
    ];


    /**
     * @var array
     */
    public static $update_profile_rules = [
        'name' => 'required|max:255',
        'email' => 'required|max:255|email|unique:users,email',
    ];

    /**
     * Validation rules labels
     *
     * @var array
     */
    public static $rules_labels = [
        'name' => 'Name',
        'email' => 'E-mail',
        'password' => 'Password',
    ];

    /**
     * @param mixed $password
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        if(!empty($password)){
            $this->attributes['password'] = bcrypt($password);
        }
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getCreatedAt($format = 'd/m/Y H:i'): string
    {
        if ($this->created_at and $this->created_at->year > 0) {
            return $this->created_at->format($format);
        }

        return '';
    }

    public function getUpdatedAt($format = 'd/m/Y H:i'): string
    {
        if ($this->updated_at and $this->updated_at->year > 0) {
            return $this->updated_at->format($format);
        }

        return '';
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use GoldSpecDigital\LaravelEloquentUUID\Foundation\Auth\User as Authenticatable;

/**
 *
 * @OA\Schema(schema="Login",
 *   @OA\Property(property="username", type="string", description="username", default="admin"),
 *   @OA\Property(property="password", type="string", description="password", default="admin@123")
 *  );
 * @OA\RequestBody(
 *     request="Login",
 *     description="Login ",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/Login")
 * )
 **/
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'username',
        'email',
        'name',
        'role_id'
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
    ];

    public function task(){
        return $this->hasMany(Task::class, 'user_id', 'id');
    }

    public function role(){
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}

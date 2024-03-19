<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Database\Query\Builder as BuilderContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use App\Models\Scopes\Enabled;

#[ScopedBy([Enabled::class])]
class User
    extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
        'enabled'
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

    public function permissions() : BuilderContract
    {
        return $this->hasManyThrough(
            Permission::class,
            RolePermission::class,
            'role_id',
            'id',
            'role_id',
            'permission_id'
        );
    }

    public function favouriteBooks() : BuilderContract
    {
        return $this->belongsToMany(
            Book::class,
            'users_books',
            'user_id',
            'book_id',
            'id',
            'id',
            User::class
        );
    }

    public function hasPermission(string $permission) : bool
    {
        return in_array(
            $permission,
            Session::get('userPermissions'),
            true
        );
    }
}

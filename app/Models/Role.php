<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Query\Builder as BuilderContract;

class Role
    extends Model
{
    use HasFactory;

    public static $regularRoleId = 2;

    public static $adminRoleId = 1;

    public static string $adminRoleCode = 'admin';

    public static string  $regularRoleCode = 'regular';

    protected $fillable = [
      'name',
      'description'
    ];

    public function permissions() : BuilderContract
    {
        return $this->belongsToMany(
            Permission::class,
            'roles_permissions',
            'permission_id',
            'role_id',
            'id',
            'id',
            Role::class
        );
    }

    public static function getId(string $code)
    {
        $id = current(
            self::query()
                ->where(
                    'code',
                '=',
                    $code
                )
                ->select('id')
                ->first()
                ->attributes
        );

        return $id;
    }
}

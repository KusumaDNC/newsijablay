<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'slug', 'permissions',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    /**
     * eloquent to get role users
     * with pivot table
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }

    /**
     * Undocumented function
     *
     * @param array $permissions
     * @return boolean
     */
    public function hasAccess(array $permissions) : bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission))
                return true;
        }
        return false;
    }

    /**
     * Undocumented function
     *
     * @param string $permission
     * @return boolean
     */
    private function hasPermission(string $permission) : bool
    {
        return $this->permissions[$permission] ?? false;
    }
}

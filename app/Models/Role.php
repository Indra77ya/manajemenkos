<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'label'];

    public function users()
    {
        // Ideally we would switch to a proper foreign key, but for now we might link by name if we keep the string column
        // OR we can rely on the fact that we will populate the dropdown from this table,
        // and the User model's 'role' attribute (string) will match 'name' here.
        // For stricter integrity, we should have added role_id to users, but the existing code uses string 'role'.
        // To satisfy "dynamic", we just source the options from DB.
        // If we want real relation, we should add role_id.
        // Let's assume for now we use the string column on users table to store the role name.
        return $this->hasMany(User::class, 'role', 'name');
    }
}

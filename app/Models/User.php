<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'plain_password', // Added for requested feature
        'role',
        'username',
        'branch_id',
        'photo_path',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        // 'plain_password', // Do not hide if we want to show it in API/Views without explicit select, though usually good practice to hide.
        // Since we pass models to view, hidden attributes are accessible via direct access $user->plain_password,
        // but hidden affects toArray/toJson. We can keep it visible or hidden, doesn't matter for Blade $user->plain_password access.
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'boolean',
        ];
    }

    public function leases()
    {
        return $this->hasMany(Lease::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', true);
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                      ->orWhere('username', 'like', '%'.$search.'%')
                      ->orWhere('email', 'like', '%'.$search.'%');
            });
        })->when($filters['role'] ?? null, function ($query, $role) {
            $query->where('role', $role);
        })->when($filters['branch_id'] ?? null, function ($query, $branchId) {
            $query->where('branch_id', $branchId);
        })->when(isset($filters['status']), function ($query) use ($filters) {
             if ($filters['status'] !== '') {
                $query->where('status', $filters['status']);
             }
        });
    }
}

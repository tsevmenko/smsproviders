<?php

namespace App\Models;

use App\Support\PolicyTypes;
use Illuminate\Database\Eloquent\Model;

class MessageSettings extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'messageTemplate',
        'transportType',
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

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function hasPermission(string $policy): bool
    {
        return Policy::query()
                ->where('name', '=', $policy)
                ->where(function ($query) {
                    $query->where([
                        ['entity_type', '=', PolicyTypes::USERS],
                        ['entity_id', '=', $this->id],
                    ])->orWhere([
                        ['entity_type', '=', PolicyTypes::ROLES],
                        ['entity_id', '=', $this->role->id],
                    ]);
                })->get()->count() > 0;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

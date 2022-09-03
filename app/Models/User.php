<?php

namespace App\Models;

use App\Helpers\InitialName;
use App\Traits\JWTAuth;
use App\Traits\Notifications\Notifiable;
use App\Traits\TapActivity;
use App\Traits\WithMedia;
use App\Traits\WithUuid;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, WithUuid, SoftDeletes, HasRoles, AuthenticationLoggable;
    use LogsActivity, CausesActivity, TapActivity;
    use WithMedia;
    use Cachable;
    use JWTAuth;

    // protected $with = [
    //     'roles',
    //     'roles.permissions',
    //     'permissions',
    // ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $dateFormat = 'U';
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'is_disabled'
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

    //protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];


    protected $primaryKey = 'id';

    protected $appends = [
        'name_initial'
    ];

    public function getKeyType()
    {
        return 'uuid';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    /**
     * Get the profile associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function authenticatable()
    {
        return $this->morphMany(AuthenticationLog::class, 'authenticatable');
    }

    public function getNameInitialAttribute()
    {
        return InitialName::make($this->name);
    }
}

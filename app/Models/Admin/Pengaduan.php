<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Pengaduan extends Model implements JWTSubject
{
    use SoftDeletes;
    /**
     * Database table
     *
     * @var string
     */
    protected $table = 'pengaduan';

    /**
     * Guarded attributes
     *
     * @var array
     */
    protected $guarded = [
        'is_active', 'created_at', 'created_by', 'updated_at',
        'updated_by', 'deleted_at', 'deleted_by'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

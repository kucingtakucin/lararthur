<?php

namespace App\Models\Admin;

use App\Models\Admin\Reference\Fakultas;
use App\Models\Admin\Reference\Prodi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Crypt;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Mahasiswa extends Model implements JWTSubject
{
    /**
     * Database table
     *
     * @var string
     */
    protected $table = 'mahasiswa';

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

    /**
     * Belongs to Prodi
     *
     * @return BelongsTo
     */
    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }

    /**
     * Belongs to Fakultas
     *
     * @return BelongsTo
     */
    public function fakultas(): BelongsTo
    {
        return $this->belongsTo(Fakultas::class);
    }

    /**
     * Get the mahasiswa's nim
     *
     * @param [type] $value
     * @return string
     */
    public function getNimAttribute($value): string
    {
        return Crypt::decryptString($value);
    }

    /**
     * Get the mahasiswa's nama
     *
     * @param [type] $value
     * @return string
     */
    public function getNamaAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    /**
     * Get the mahasiswa's prodi_id
     *
     * @param [type] $value
     * @return string
     */
    public function getProdiIdAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    /**
     * Get the mahasiswa's fakultas_id
     *
     * @param [type] $value
     * @return string
     */
    public function getFakultasIdAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    /**
     * Get the mahasiswa's angkatan
     *
     * @param [type] $value
     * @return string
     */
    public function getAngkatanAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    /**
     * Get the mahasiswa's foto
     *
     * @param [type] $value
     * @return void
     */
    public function getFotoAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    /**
     * Set the mahasiswa's nim
     *
     * @param [type] $value
     * @return void
     */
    public function setNimAttribute($value)
    {
        $this->attributes['nim'] = Crypt::encryptString($value);
    }

    /**
     * Set the mahasiswa's nama
     *
     * @param [type] $value
     * @return void
     */
    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = Crypt::encryptString($value);
    }

    /**
     * Set the mahasiswa's prodi_id
     *
     * @param [type] $value
     * @return string
     */
    public function setProdiIdAttribute($value)
    {
        $this->attributes['prodi_id'] = Crypt::encryptString($value);
    }

    /**
     * Set the mahasiswa's fakultas_id
     *
     * @param [type] $value
     * @return string
     */
    public function setFakultasIdAttribute($value)
    {
        $this->attributes['fakultas_id'] = Crypt::encryptString($value);
    }

    /**
     * Set the mahasiswa's angkatan
     *
     * @param [type] $value
     * @return string
     */
    public function setAngkatanAttribute($value)
    {
        $this->attributes['angkatan'] = Crypt::encryptString($value);
    }

    /**
     * Set the mahasiswa's foto
     *
     * @param [type] $value
     * @return void
     */
    public function setFotoAttribute($value)
    {
        $this->attributes['foto'] = Crypt::encryptString($value);
    }
}

<?php

namespace App\Models\Admin\Reference;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'fakultas';

    protected $guarded = [
        'is_active', 'created_at', 'created_by', 'updated_at',
        'updated_by', 'deleted_at', 'deleted_by'
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}

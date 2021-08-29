<?php

namespace App\Models\Admin\Reference;

use App\Models\Admin\Mahasiswa;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';

    protected $guarded = [
        'is_active', 'created_at', 'created_by', 'updated_at',
        'updated_by', 'deleted_at', 'deleted_by'
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}

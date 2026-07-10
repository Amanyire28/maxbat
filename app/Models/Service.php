<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name','icon','description','sort_order','active','file_upload_enabled','file_types'];

    protected $casts = ['active' => 'boolean', 'file_upload_enabled' => 'boolean'];

    public function getFileTypesArrayAttribute(): array
    {
        if (!$this->file_types) return [];
        return array_filter(array_map('trim', explode(',', $this->file_types)));
    }

    public function fileSubmissions()
    {
        return $this->hasMany(\App\Models\FileSubmission::class);
    }
}

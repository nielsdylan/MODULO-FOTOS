<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'albumes';
    protected $fillable = ['titulo','descripcion','usuario_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function imagenes(): HasMany
    {
        return $this->hasMany(Image::class, 'album_id');
    }
}

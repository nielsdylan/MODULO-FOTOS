<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'customers';
    protected $fillable = ['numero_documento','nombres','apellidos', 'email', 'telefono', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}

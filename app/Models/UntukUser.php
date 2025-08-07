<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UntukUser extends Model
{
    use HasFactory;
    
    protected $table = 'untukuser';

    protected $fillable = ['logo', 'gambar', 'deskripsi', 'stock'];
}

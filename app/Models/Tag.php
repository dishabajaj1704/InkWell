<?php

namespace App\Models;

use Dotenv\Repository\Adapter\GuardedWriter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_by', 'last_updated_by'];

    //     TODO:Difference between fillable and guarded
//     protected $guarded=[];



    public function blogs()
    {
        return $this->belongsToMany(Blog::class)->withTimestamps();
    }
}

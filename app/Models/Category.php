<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_by', 'last_updated_by'];
    //protected $guarded = [];


    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }


}

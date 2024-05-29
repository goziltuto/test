<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['amount', 'date', 'type_id', 'comment'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
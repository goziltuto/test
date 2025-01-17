<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * モデルでタイムスタンプを使用しない
     *
     * @var bool
     */
    public $timestamps = false;

    use HasFactory;

    protected $fillable = ['name'];
}

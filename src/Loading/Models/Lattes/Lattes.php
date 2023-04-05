<?php

namespace Src\Loading\Models\Lattes;

use Illuminate\Database\Eloquent\Model;

class Lattes extends Model
{
    protected $table = 'lattes';
    protected $guarded = [];
    protected $casts = ['lattes' => 'array'];
}
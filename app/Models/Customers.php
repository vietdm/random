<?php

namespace App\Models;

use App\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory, ModelTrait;

    protected $table = 'customers';
}

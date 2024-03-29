<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    public function stocks() {
      return $this->hasMany(Stock::class);
    }

    protected $fillable = ['name', 'lang'];
}

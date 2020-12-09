<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['path'];

    public function product() {
      return $this->belongsTo(Product::class);
    }

    public function color() {
      return $this->belongsTo(Color::class);
    }

    public function getPathAttribute() {
      return asset('storage/'.$this->photo);
    }
}

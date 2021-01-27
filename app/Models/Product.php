<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['url','img'];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function stocks() {
      return $this->hasMany(Stock::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getImgAttribute() {
      return url('storage/'.$this->photo);
    }

    public function path() {
      return route('product.show', [$this->id, Str::slug($this->title)]);
    }

    public function getUrlAttribute() {
      return route('product.show', [$this->id,Str::slug($this->title)]);
    }

    public function scopeWithFilters($query, $brands, $colors, $min,$max)
    {
      return $query->when($brands, function ($query) use ($brands) {
        $query->whereIn('brand_id', $brands);
      })
        ->when($colors, function ($query) use ($colors) {
          $query->whereIn('color_id', $colors);
        })
        ->whereBetween('price',[$min,$max]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['url','img','sn','colors'];

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

    public function getUrlAttribute() {
      return route('product.show', [$this->id,Str::slug($this->title)]);
    }

    public function getColorsAttribute() {
      return $this->stocks()->select('color_id','quantity','photo')->get();
    }

    public function getSNAttribute() {
      return $this->store->name;
    }

    public function path() {
      return route('product.show', [$this->id, Str::slug($this->title)]);
    }

    public function scopeWithFilters($query,$brands, $colors, $min, $max,$sort)
    {

      return $query->when($brands, function ($query) use ($brands) {
        $query->whereIn('brand_id', $brands);
      })
        ->when($min || $max,function ($query) use ($max,$min) {
          $query->whereBetween('price',[$min,$max]);
        })
        ->when($colors, function ($query) use ($colors) {
          $query->join('stocks as s', function ($join) use ($colors) {
            $join->on('products.id', '=', 's.product_id')
                  ->whereIn('s.color_id', $colors);
          });
        })
        ->when($sort == 'asc' or $sort == 'desc', function ($query) use ($sort) {
          $query->orderby('price', $sort);
        })
        ->select('products.*');

    }

}

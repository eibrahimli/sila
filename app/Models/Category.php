<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['url'];

    public function parent() {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function categories() {
        return $this->hasMany(Category::class,'category_id');
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function desc() {
        return strlen($this->desc) > 25 ? mb_substr($this->desc,0,22).'...' : $this->desc;
    }
    public function keyw() {
        return strlen($this->keyw) > 25 ? mb_substr($this->keyw,0,22).'...' : $this->keyw;
    }

    public function name() {
        return strlen($this->name) > 23 ? mb_substr($this->name,0,20).'...' : $this->name;
    }

    public function getUrlAttribute() {
      return route('category.show', [$this->id,Str::slug($this->name)]);
    }

    public function path() {
      return route('category.show', [$this->id,Str::slug($this->name)]);
    }


}

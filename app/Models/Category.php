<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

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
        return strlen($this->desc) > 25 ? mb_substr($this->desc,0,23).'..' : $this->desc;
    }
    public function keyw() {
        return strlen($this->keyw) > 25 ? mb_substr($this->keyw,0,23).'..' : $this->keyw;
    }

    public function name() {
        return strlen($this->name) > 30 ? mb_substr($this->name,0,28).'..' : $this->name;
    }
}

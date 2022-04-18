<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected $append = ['date'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function getDateAttribute() {
    return \Illuminate\Support\Carbon::parse($this->created_at)->format('d/m/y');
  }

  public function rules() {
      return [
          'note' => 'sometimes',
          'name' => 'required|min:2',
          'surname' => 'required|min:2',
          'email' => 'required|email',
          'password' => 'sometimes|min:8',
          'number' => 'required',
          'city' => 'required',
          'adress' => 'required',
          'post_code' => 'sometimes|required|nullable',
          'payment_method' => 'required'
      ];
  }
}
<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductActivated extends Mailable
{
  use Queueable, SerializesModels;

  public $product;

  /**
   * Create a new message instance.
   *
   * @param Product $product
   */
  public function __construct(Product $product)
  {
    $this->product = $product;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->subject('Məhsul Aktiv Edildi...')
                ->markdown('emails.product.activated');
  }
}

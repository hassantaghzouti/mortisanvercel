<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ["product_id","image_link","image_description"];  

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

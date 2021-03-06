<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timespams = false;
    protected $fillable = ['product_name','product_status','product_desc','product_price','product_image','product_content','category_id','brand_id'];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
}

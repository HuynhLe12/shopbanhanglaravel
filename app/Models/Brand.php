<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public $timespams = false;
    protected $fillable = ['brand_name','brand_status','brand_desc'];
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand';
}

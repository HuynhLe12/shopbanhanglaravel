<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    public $timespams = false;
    protected $fillable = ['shipping_name','shipping_email','shipping_address','shipping_phone','shipping_note'];
    protected $primaryKey = 'shipping_id';
    protected $table = 'tbl_shipping';
}

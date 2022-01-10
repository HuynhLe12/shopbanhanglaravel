<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $timespams = false;
    protected $fillable = ['customer_nameus','customer_email','customer_password','customer_phone'];
    protected $primaryKey = 'customer_id';
    protected $table = 'tbl_customer';
}

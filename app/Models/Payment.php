<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public $timespams = false;
    protected $fillable = ['payment_method','payment_status'];
    protected $primaryKey = 'payment_id';
    protected $table = 'tbl_payment';
}

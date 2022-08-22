<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $title;
    public $description;
    public $price;
    public $image_path;

}

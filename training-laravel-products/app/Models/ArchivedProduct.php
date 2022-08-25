<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivedProduct extends Model
{
    use HasFactory;
    protected $table = 'archived_products';
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
        'price',
        'image_path'
    ];

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'orders');
    }
}

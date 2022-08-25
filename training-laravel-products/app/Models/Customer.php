<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'contact',
        'comment'
    ];
//    public $id;
//    public $name;
//    public $contact;
//    public $comment;
//    public $creationDate;
//    public $totalPrice;
//    public $archivedProductsArray;

    public function products()
    {
        return $this->belongsToMany(ArchivedProduct::class, 'orders');
    }

}

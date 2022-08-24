<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $name;
    public $contact;
    public $comment;
    public $totalPrice;
    public $creationDate;
    public $archivedProductsArray;


    public function __construct($name, $contact, $comment, $totalPrice, $archivedProductsArray)
    {
        $this->name = $name;
        $this->contact = $contact;
        $this->comment = $comment;
        $this->totalPrice = $totalPrice;
        $this->archivedProductsArray = $archivedProductsArray;
        return $this;
    }


}

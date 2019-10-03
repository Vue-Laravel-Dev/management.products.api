<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "sku"
    ];

    protected $casts = [
        'quantity_reserved_details' => 'array'
    ];

    public function reserve($quantity, $comment): Product
    {

        $this->increment('quantity_reserved', $quantity);

        $this->addReservedComment($quantity, $comment);

        $this->save();

        return $this;

    }

    /**
     * @param $quantity
     * @param $comment
     * @return Product
     */
    public function addReservedComment($quantity, $comment): Product
    {
        $quantity_reserved_details = $this->quantity_reserved_details;

        $quantity_reserved_details[] = [
            "quantity" => $quantity,
            "comment" => $comment
        ];

        $this->quantity_reserved_details = $quantity_reserved_details;

        return $this;
    }
}

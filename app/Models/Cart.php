<?php

namespace App\Models;

class Cart
{
    public $items;

    public $totalQuantity = 0;

    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQuantity = $oldCart->totalQuantity;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function Add($item, $id)
    {
        $storedItem = ['quantity' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }

        $storedItem['quantity']++;
        $storedItem['price'] = $item->price * $storedItem['quantity'];

        $this->items[$id] = $storedItem;
        $this->totalQuantity++;
        $this->totalPrice += $item->price;

    }

    public function ReduceByOne($id)
    {
        $this->items[$id]['quantity']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalQuantity--;
        $this->totalPrice -= $this->items[$id]['item']['price'];

        if ($this->items[$id]['quantity'] <= 0) {
            unset($this->items[$id]);
        }
    }

    public function RemoveItem($id)
    {
        $this->totalQuantity -= $this->items[$id]['quantity'];
        $this->items[$id]['quantity'] -= $this->items[$id]['quantity'];
        $this->totalPrice -= $this->items[$id]['price'];
        $this->items[$id]['price'] -= $this->items[$id]['price'];

        unset($this->items[$id]);
    }
}

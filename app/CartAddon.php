<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
class CartAddon extends Authenticatable
{
    protected $table = 'cart_addon';

    public function addNew($data,$id)
    {
        $addon = isset($data['addon']) ? $data['addon'] : [];
        $addon_qty = isset($data['addon_qty']) ? $data['addon_qty'] : [];

        for($i=0;$i<count($addon);$i++)
        {
            $add            = new CartAddon;
            $add->cart_id   = $id;
            $add->item_id   = $data['id'];
            $add->addon_id  = $addon[$i];
            
            // Si el frontend envía cantidades específicas por addon, multiplicarlo por la cantidad del platillo principal
            if (isset($addon_qty[$addon[$i]])) {
                $add->qty = $data['qty'] * $addon_qty[$addon[$i]];
            } else {
                $add->qty = $data['qty'];
            }
            
            $add->save();
        }
    }
}

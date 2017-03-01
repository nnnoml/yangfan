<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopRelationModel extends Model
{
    protected $table = 'shops_relation';

    public static function getAll()
    {
        return self::paginate(15);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    private static $listName = [1 => '応募', 2 => '契約中', 3 => '納品済み', 4 => '検収完了'];
    public function getStatusName()
    {
        return self::$listName[$this->status];
    }
}

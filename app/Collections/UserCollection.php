<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class UserCollection extends Collection {
    public function overview() {
        return array_map(function($item){
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'icon_url' => $item['icon_url'],
            ];
        }, $this->items);
    }
}

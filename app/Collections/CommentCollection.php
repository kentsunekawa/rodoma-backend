<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class CommentCollection extends Collection {
    public function overview() {
        return array_map(function($item){
            return [
                'id' => $item['id'],
                'comment' => $item['comment'],
                'created_at' => $item['created_at'],
                'user' => [
                    'id' => $item['user']['id'],
                    'name' => $item['user']['name'],
                    'icon_url' => $item['user']['icon_url'],
                ],
            ];
        }, $this->items);
    }
}

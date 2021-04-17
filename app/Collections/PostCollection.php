<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class PostCollection extends Collection {
    public function overview() {
        return array_map(function($item){
            return [
                'id' => $item['id'],
                'title' => $item['title'],
                'release_status' => $item['release_status'],
                'category_id' => $item['category_id'],
                'specialty_id' => $item['specialty_id'],
                'likes_count' => $item['likes_count'],
                'marks_count' => $item['marks_count'],
                'eye_catch_url' => $item['eye_catch_url'],
                'user' => [
                    'id' => $item['user']['id'],
                    'name' => $item['user']['name'],
                    'icon_url' => $item['user']['icon_url'],
                ],
            ];
        }, $this->items);
    }
}

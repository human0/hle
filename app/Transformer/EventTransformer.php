<?php
 
namespace App\Transformer;
 
class EventTransformer {
 
    public function transform($event) {
        return [
            'id' => $event->id,
            'name' => $event->name,
            'description' => $event->description,
            'location' => $event->location,
            'start' => $event->start,
            'end' => $event->end,
        ];
    }
 
}
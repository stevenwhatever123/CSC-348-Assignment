<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class LikeAction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post_id;
    public $action;

    public function __construct($post_id, $action)
    {
        $this->post_id = $post_id;
        $this->action = $action;
    }
}
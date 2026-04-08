<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    // Channels: database only (you can also add mail)
    public function via($notifiable)
    {
        return ['database'];
    }

    // Database notification payload
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->order_id,
            'message' => "New order received for product: {$this->order->product_name}, quantity: {$this->order->quantity}",
            'url' => route('orders.index', $this->order->id), // Link to order details
        ];
    }
}
<?php

namespace App\Livewire\Message;

use Livewire\Component;

class SendMessage extends Component
{
    public $message = '';

    public function send ()
    {
        $this->dispatch('messageSent', $this->message);

        $this->message = '';
    }

    public function render()
    {
        return view('livewire.message.send-message');
    }
}

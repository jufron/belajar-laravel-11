<?php

namespace App\Livewire\Message;

use Livewire\Component;
use Livewire\Attributes\On;

class ShowMessage extends Component
{
    public string $latestMessage = '';

    #[On('messageSent')]
    public function updateMessage($message)
    {
        $this->latestMessage = $message;
    }

    public function render()
    {
        return view('livewire.message.show-message');
    }
}

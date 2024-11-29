<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Notification extends Component
{
    public $message = '';
    public $type = 'success'; // Tipo de notificação: 'success' ou 'error'
    public $show = false;

    #[On('notify')]
    public function notify($data)
    {
        $this->message = $data['message'] ?? 'Algo aconteceu.';
        $this->type = $data['type'] ?? 'success';
        $this->show = true;

        // Esconde a notificação automaticamente após 3 segundos
        $this->dispatch('hide-notification', ['timeout' => 3000]);
    }
    public function render()
    {
        return view('livewire.notification');
    }
}

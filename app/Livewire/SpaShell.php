<?php

namespace App\Livewire;

use Livewire\Component;

class SpaShell extends Component
{
    public string $currentPage = 'home';

    public function setPage(string $page)
    {
        $this->currentPage = $page;
    }

    public function render()
    {
        return view('livewire.spa-shell')->layout('layouts.app');
    }
}

<?php

namespace Totaa\TotaaPoster\Http\Livewire;

use Livewire\Component;
use Auth;
use Illuminate\Support\Facades\Cache;

class NhomLivewire extends Component
{
    /**
     * render view
     *
     * @return void
     */
    public function render()
    {
        return view('totaa-poster::livewire.nhom.nhom-livewire');
    }

}

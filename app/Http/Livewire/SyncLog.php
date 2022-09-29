<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SyncLog extends Component
{



    public $log="";

    protected $listeners = ['chunk_downloaded'];

    public function chunk_downloaded($log)
    {
        $this->log = $log;

    }

    public function mount()
    {
        $this->log = "";
    }

    public function update()
    {


    }


    public function render()
    {
        return view('livewire.sync-log');
    }


}

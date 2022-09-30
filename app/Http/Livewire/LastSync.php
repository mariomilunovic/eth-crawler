<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LastSync extends Component
{

    public $last_sync;
    public $wallet;

    protected $listeners = ['sync_finished'];

    public function get_last_sync()

    {
        if ($this->wallet->synced_at)
        return \Carbon\Carbon::parse($this->wallet->synced_at)->diffForHumans();
        else
        return 'never';
    }

    public function sync_finished()
    {
        $this->update();
    }


    public function mount()
    {
        $this->last_sync = $this->get_last_sync();
    }
    

    public function update()
    {
        $this->last_sync = $this->get_last_sync();
    }


    public function render()
    {
        return view('livewire.last-sync');
    }
}

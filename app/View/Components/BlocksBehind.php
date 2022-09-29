<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BlocksBehind extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $blocks_behind;

    public function __construct($wallet)
    {
        $this->blocks_behind = $wallet->get_latest_block() - $wallet->transactions()->max('blockNumber');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks-behind');
    }
}

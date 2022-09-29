{{-- <div wire:poll.750ms="update" class="p-4"> --}}
    <div>
        <span class="font-bold"> Latest block : </span><span>{{$latest_block}}</span>
        <div>
            Current time: {{Carbon\Carbon::now()}}
        </div>
    </div>

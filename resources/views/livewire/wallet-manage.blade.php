<div>

    <x-wallet :wallet="$wallet"/>

    <button wire:click="fetch_all" class="btn-green-medium">Fetch transactions</button>

    {{-- custom spinner --}}
    <div wire:loading class="cssload-container col-sm-1">
        <div class="cssload-speeding-wheel"></div>
    </div>
    

</div>

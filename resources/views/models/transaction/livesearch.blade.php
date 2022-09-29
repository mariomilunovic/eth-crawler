<x-main>
    <div>
        <x-title title="Show wallet transactions by block range"/>
        {{-- {{dd($wallets)}} --}}
        <livewire:live-search :wallets="$wallets"/>

    </div>
</x-main>

<x-main>
    <div class="flex-col pb-3 mb-3 w-full sm:w-800">

        <x-title title="{{count($transactions)}} transactions found"/>



        @if (count($transactions))


        @foreach ($transactions as $transaction)
        <x-transaction :transaction="$transaction"/>
        @endforeach


        @else
        <div>No transactions found</div>
        @endif

    </div>
</x-main>

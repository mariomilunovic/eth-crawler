<x-main>
    <div class="flex-col pb-3 mb-3 w-full sm:w-800">

        <x-title title="{{$total}} transactions found"/>



        @if (count($transactions))


        @foreach ($transactions as $transaction)
        <x-transaction :transaction="$transaction"/>
        @endforeach

        {{$transactions->links()}}

        @else
        <div>No transactions found</div>
        @endif

    </div>
</x-main>

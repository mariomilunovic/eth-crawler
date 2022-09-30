<div class="flex flex-col">

    {{--        SEARCH INPUT       --}}

    <form wire:submit.prevent="search" class="py-2">

        <!-- User input start -->
        <div class="card bg-neutral-400 flex-col sm:flex-row px-3 justify-start items-start pb-2">

            <div class="flex flex-col flex-grow">
                <label for="wallet_id" class="label">Wallet address</label>
                <select wire:model="wallet_id" id="wallet_id" name="wallet_id" class="input">
                    <option value="">Select wallet</option>
                    @foreach($wallets as $wallet )
                    <option value="{{$wallet->id}}">{{$wallet->name}} - {{$wallet->address}}</option>
                    @endforeach
                </select>
                <div class="error">@error ('wallet_id'){{ $message }}@enderror</div>
            </div>

            <div class="flex flex-col pl-3">
                <label for="startblock" class="label">Start block</label>
                <input wire:model="startblock" type="text" id="startblock" name="startblock" placeholder="Enter start block number" value="{{old('startblock')}}" class="input">
                <div class="error">@error ('startblock'){{ $message }}@enderror</div>

            </div>
            <div class="flex flex-col pl-3">
                <label for="endblock" class="label">End block</label>
                <input wire:model="endblock" type="text" id="endblock" name="endblock" placeholder="{{$wallet->get_latest_block()}}" value="{{old('endblock')}}" class="input">
                <div class="error">@error ('endblock'){{ $message }}@enderror</div>

            </div>
            <div class="flex flex-col pl-2 pt-8">

                <button type="submit" class="btn-blue">
                    Search
                    <svg wire:loading role="status" class="inline ml-2 w-4 h-4 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>

                    </svg>

                </button>

            </div>




        </div>
        <!-- User input end -->

    </form>
    <div class="py-3">
        <div class="{{$messageClass}}">
            {{$message}}
        </div>
    </div>

    {{--        SEARCH RESULTS     --}}
    @if($transactions && count($transactions)>0)

    @foreach ($transactions as $transaction)
    <x-transaction :transaction="$transaction"/>
    @endforeach

    {{-- {{$transactions->links()}} --}}

    <button wire:click="load" class="btn-blue-small">Load more</button>
    @endif

</div>

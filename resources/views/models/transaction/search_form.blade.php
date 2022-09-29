<x-main>


    <div class="flex-col mb-3 pb-3 w-full ">

        <x-title title="Show transactions by block range"/>

        <form action="{{route('transaction.search')}}" method="post" class="" autocomplete="off">

            @csrf

            <!-- User input start -->
            <div class="card bg-neutral-400 flex-col sm:flex-row px-3 justify-start items-start pb-2">

                <div class="flex flex-col flex-grow">
                    <label for="wallet_id" class="label">Wallet address</label>
                    <select id="wallet_id" name="wallet_id" class="input">
                        <option value="">Select wallet</option>
                        @foreach($wallets as $wallet )
                        <option value="{{$wallet->id}}">{{$wallet->name}} - {{$wallet->address}}</option>
                        @endforeach
                    </select>
                    <div class="error">@error ('wallet_id'){{ $message }}@enderror</div>
                </div>

                <div class="flex flex-col pl-3">
                    <label for="startblock" class="label">Start block</label>
                    <input type="text" id="startblock" name="startblock" placeholder="Enter start block number" value="{{old('startblock')}}" class="input">
                    <div class="error">@error ('startblock'){{ $message }}@enderror</div>

                </div>
                <div class="flex flex-col pl-3">
                    <label for="endblock" class="label">End block</label>
                    <input type="text" id="endblock" name="endblock" placeholder="{{$wallet->get_latest_block()}}" value="{{old('endblock')}}" class="input">
                    <div class="error">@error ('endblock'){{ $message }}@enderror</div>

                </div>
                <div class="flex flex-col pl-3 pt-7">

                    <button type="submit" class="btn-blue-small">Search</button>

                </div>




            </div>
            <!-- User input end -->

        </form>
    </div>
</x-main>

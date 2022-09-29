<x-main>


    <div class="flex-col mb-3 pb-3 w-full sm:w-600">

        <x-title title="Get all transactions by wallet address"/>

        <form action="{{route('transaction.search')}}" method="post" class="" autocomplete="off">

            @csrf

            <!-- User input start -->
            <div class="card bg-blue-300 flex-col p-3 mb-3">

                <label for="address" class="label">Wallet address</label>
                <input type="text" id="address" name="address" placeholder="Enter wallet address" value="{{old('address')}}" class="w-full input">
                <div class="error">@error ('address'){{ $message }}@enderror</div>

                <label for="startblock" class="label">Start block</label>
                <input type="text" id="startblock" name="startblock" placeholder="Enter start block number" value="{{old('startblock')}}" class="w-full input">
                <div class="error">@error ('startblock'){{ $message }}@enderror</div>


                <button type="submit" class="mt-3 w-full btn-blue-medium">
                    Start
                </button>
                <a href="{{route('transaction.search')}}" class="block mt-3 w-full btn-red-medium">Cancel</a>
            </div>
            <!-- User input end -->

        </form>
    </div>
</x-main>

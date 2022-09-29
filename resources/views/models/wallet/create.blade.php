<x-main>


    <div class="flex-col mb-3 pb-3 w-full sm:w-600">

        <x-title title="Add new tracked wallet"/>

        <form action="{{route('wallet.store')}}" method="post" class="" autocomplete="off">

            @csrf

            <!-- User input start -->
            <div class="card bg-neutral-400 flex-col p-3 mb-3">

                <label for="address" class="label">Wallet address</label>
                <input type="text" id="address" name="address" placeholder="Enter wallet address" value="{{old('address')}}" class="w-full input">
                <div class="error">@error ('address'){{ $message }}@enderror</div>

                <label for="name" class="label">Wallet name</label>
                <input type="text" id="name" name="name" placeholder="Enter wallet name" value="{{old('name')}}" class="w-full input">
                <div class="error">@error ('name'){{ $message }}@enderror</div>


                <button type="submit" class="mt-3 w-full btn-blue-medium">
                    Confirm
                </button>
                <a href="{{route('wallet.index')}}" class="block mt-3 w-full btn-red-medium">Cancel</a>
            </div>
            <!-- User input end -->

        </form>
    </div>
</x-main>

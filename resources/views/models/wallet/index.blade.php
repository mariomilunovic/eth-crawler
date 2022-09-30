<x-main>
    <div class="flex-col pb-3 mb-3">

        <x-title title="Tracked wallets"/>


        @if ($wallets->count()>0)

        <table class="styled-table">
            <thead>
                <tr>
                    <th>Wallet name</th>
                    <th>Address</th>
                    <th>Added</th>
                    <th>Balance</th>
                    <th>Total txn in db</th>
                    <th>Last sync</th>
                    <th></th>
                    <th></th>
                    {{-- <th></th> --}}

                </tr>
            </thead>

            <tbody>

                @foreach ($wallets as $wallet)
                <tr class="text-sm">
                    {{-- <a href="{{route('wallet.show',$wallet)}}"> --}}
                        <x-wallet :wallet="$wallet"/>
                        {{-- </a> --}}
                    </tr>
                    @endforeach


                </tbody>



            </table>


            {{$wallets->links()}}

            @else
            <div>No tracked wallets found</div>
            @endif

        </div>
    </x-main>

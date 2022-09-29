<nav  class="card-vertical bg-neutral-600 items-end">

    {{-- wallets menu --}}
    <div class="w-full" x-data="{ expanded_wallet: $persist(false) }">
        <a @click="expanded_wallet = !expanded_wallet"  class="menu_item shadow-md" href="#">
            <img src="/svg/wallet.svg" class="h-6 w-6" />

            <div class="mx-4 font-bold">
                Wallets
            </div>
        </a>

        {{-- submenu_text --}}
        <div x-show="expanded_wallet" x-collapse x-cloak >
            <a class="submenu_item" href="{{route('wallet.create')}}">Add New</a>
            <a class="submenu_item" href="{{route('wallet.index')}}">Show All</a>
        </div>
    </div>

    {{-- transactions menu --}}
    <div class="w-full" x-data="{ expanded_transactions: $persist(false) }">
        <a @click="expanded_transactions = !expanded_transactions"  class="menu_item shadow-md" href="#">
            <img src="/svg/transaction.svg" class="h-6 w-6" />

            <div class="mx-4 font-bold">
                Transactions
            </div>
        </a>

        {{-- submenu_text --}}
        <div x-show="expanded_transactions" x-collapse x-cloak >
            <a class="submenu_item" href="{{route('transaction.livesearch')}}">Search</a>
            {{-- <a class="submenu_item" href="{{route('transaction.show_search_form')}}">Search</a> --}}
            <a class="submenu_item" href="{{route('transaction.api_test')}}">API Test</a>
        </div>
    </div>

</nav>

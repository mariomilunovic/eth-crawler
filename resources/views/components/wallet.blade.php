<div>
    <td>{{$wallet->name}}</td>
    <td>
        <div  x-data="{ isCollapsed: false }">
            <span  x-text="isCollapsed ? '{{$wallet->address}}': '{{Str::limit($wallet->address,10)}}'"></span>
            <span  x-text="isCollapsed ? ' hide' : ' show'" x-on:click="isCollapsed = !isCollapsed" @click.outside="isCollapsed = false"  class="font-bold hover:cursor-pointer"></span>
        </div>
    </td>
    <td>{{Carbon\Carbon::parse($wallet->created_at)->diffForHumans()}}</td>
    <td><livewire:balance :wallet="$wallet" /></td>
    <td><livewire:tx-counter  :wallet="$wallet"/></td>
    <td><livewire:last-sync :wallet="$wallet" /></td>
    <td><livewire:transaction-fetch :wallet="$wallet"/></td>
    <td><a href="{{route('wallet.transactions',$wallet)}}" class="btn-green">Show all transactions</a></td>
    {{-- <td><a href="{{route('transaction.show_search_form',$wallet)}}" class="btn-red">Search</a></td> --}}
</div>

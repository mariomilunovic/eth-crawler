{{-- transaction card start --}}
<div class="card flex flex-col items-start text-neutral-700 transition duration-300 bg-lime-500 hover:ring-4 hover:ring-neutral-600 ease-in-out text-shadow p-3 mb-3">

    <div><span class="font-semibold">Txn hash : </span> {{$transaction->hash}}</div>
    <div><span class="font-semibold">From : </span> {{$transaction->from}}</div>
    <div><span class="font-semibold">To : </span>{{$transaction->to}}</div>
    <div><span class="font-semibold">Value : </span>{{number_format($transaction->value/10**18, 18)}} ETH</div>
    <div class="w-full flex flex-row justify-between items-center">
        <div>
            <span class="font-semibold">Block : </span>
            <span>{{$transaction->blockNumber}}</span>
        </div>
        <div>
            <span class="font-semibold">Timestamp : </span>
            <span>{{Carbon\Carbon::createFromTimestamp($transaction->timeStamp)}} ({{Carbon\Carbon::createFromTimestamp($transaction->timeStamp)->diffForHumans()}})</span>

        </div>
    </div>

</div>
{{-- transaction card end --}}

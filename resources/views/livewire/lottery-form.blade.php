<div>
    <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Selecione 15 números entre 1 e 25.') }} ou
            <button wire:click="randomSelect" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-12">aleatoriamente</button>
        </div>
        @if(!empty($statusMessage))
            <div class="mb-4 text-sm text-green-600">
                {{ $statusMessage }}
            </div>
        @endif
        <div class="grid grid-cols-5 gap-4">
            @foreach(range(1, 25) as $number)
                <button 
                wire:click="toggleNumber({{ $number }})" 
                class="w-full py-2 text-center text-white font-bold rounded {{ in_array($number, $selectedNumbers) ? 'bg-green-500' : 'bg-blue-500' }} hover:bg-blue-700"
                wire:disabled="isNumberDisabled({{ $number }})">
                {{ $number }}
            </button>
            @endforeach
            

        </div>

        @if(count($selectedNumbers) >= 15)
            <button wire:click="save" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-5">Confirmar</button>
        @endif

        <ul>
            {{-- @foreach($selectedNumbers as $number)
                <li>{{ $number }}</li>
            @endforeach --}}
        </ul>
    </x-authentication-card>
</x-guest-layout>

</div>
<script>
    window.addEventListener('clear-message', event => {
        setTimeout(() => {
            @this.set('statusMessage', null);
        }, event.detail.timeout);
    });
</script>

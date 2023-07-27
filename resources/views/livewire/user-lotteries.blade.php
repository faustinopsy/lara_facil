<div>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
    </style>
    <h1>Suas Loterias</h1>
<input type="date" wire:model="dataSorteio">
    <button wire:click="buscar">Buscar</button>
@if ($statusMessage)
    <p>{{ $statusMessage }}</p>
@endif


    @if(is_array($resultados) && count($resultados) > 0)
         @foreach ($resultados as $resultado)
        @if(isset($resultado['lottery']) && is_object($resultado['lottery']))
            <p>Número de acertos para o jogo {{ $resultado['lottery']->id }}: {{ $resultado['acertos'] }}</p>
        @endif
    @endforeach
    @endif
    <table class="table-auto w-full">
        <thead>
            <tr>
             
                @for ($i = 1; $i <= 15; $i++)
                    <th>N {{ $i }}</th>
                @endfor
                <th></th> 
                <th>Excluir</th>
            </tr>
        </thead>
 <tbody>
    @foreach ($lotteries as $lottery)
        <tr>
            @for ($i = 1; $i <= 15; $i++)
                @if($resultados)
                    @php 
                     if(isset($resultado['lottery']) && is_object($resultado['lottery'])){
                        $res = array_filter($resultados, function($r) use($lottery) {
                            return $r['lottery']->id == $lottery->id;
                        });
                     }
                        
                    @endphp
                    @if(!empty($res))
                        @php
                            $firstRes = reset($res);
                        @endphp
                        @if(in_array($lottery["number_$i"], $firstRes['acertados']))
                            <td style="text-decoration: line-through;text-decoration: strong">{{ $lottery["number_$i"] }}</td>
                        @else
                            <td>{{ $lottery["number_$i"] }}</td>
                        @endif
                    @else
                        <td>{{ $lottery["number_$i"] }}</td>
                    @endif
                @else
                    <td>{{ $lottery["number_$i"] }}</td>
                @endif
            @endfor
            <td>
                <button wire:click="editar({{ $lottery->id }})"></button>
            </td>
            <td>
                <button wire:click="excluir({{ $lottery->id }})">Excluir</button>
            </td>
        </tr>
    @endforeach
</tbody>



    </table>
</div>

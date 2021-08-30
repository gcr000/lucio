@if(count($houses))
    <table class="table table-responsive" style="margin-top: 20px!important;">
        <thead>
        <tr>
            <th style="text-align: center;">#</th>
            <th style="text-align: center;">Utente</th>
            <th style="text-align: center;">Vani</th>
            <th style="text-align: center;">Prezzo</th>
            <th style="text-align: center;">Note</th>
            <th style="text-align: center;">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($houses as $house)
            <tr>
                <td style="white-space: nowrap; text-align: center">{{$house->id}}</td>
                <td style="white-space: nowrap; text-align: center">{{$house->user->name}}</td>
                <td style="white-space: nowrap; text-align: center">{{$house->rooms}}</td>
                <td style="white-space: nowrap; text-align: center">{{number_format($house->price,2,',','.')}} €</td>
                <td>{{$house->note}}</td>
                <td><a href="{{url('/')}}/structures/{{$house->id}}" class="btn btn-sm btn-outline-primary">Dettagli</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $houses->links('pagination::bootstrap-4') !!}

@else
    <br>
    &nbsp;
    <p class="text-center"><i>Nessun risultato trovato</i></p>
@endif

<style>

</style>



@extends('layouts.app')

@section('content')
    <h1>Historie výzev</h1>

    <table class="table table-sm">
        <tr>
            <th>&nbsp;</th>
            <th>Výzva</th>
            <th>Stav</th>
            <th>Datum splnění&nbsp;/&nbsp;odložení</th>
        </tr>
        @foreach($historie as $item)
            <tr class="status-{{ $item->status }}">
                @if($item->status == 'splneno')
                    <td><span class="fas fa-check text-success"></span></td>
                @else
                    <td><span class="fas fa-times text-danger"></span></td>
                @endif
                @if($item->status == 'splneno')
                        <td><strong>{{ $vyzva[$item->challenge_id] }}</strong></td>
                @else
                    <td class="text-muted">{{ $vyzva[$item->challenge_id] }}</td>
                @endif
                @if($item->status == 'splneno')
                    <td class="text-success">splněno</td>
                @else
                    <td class="text-danger">odloženo</td>
                @endif
                <td>{{ $item->created_at->format('d.m.Y H:i:s') }}</td>
            </tr>
        @endforeach
    </table>
@endsection
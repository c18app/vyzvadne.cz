@extends('layouts.app')

@section('content')
    <h1>
        Dashboard
    </h1>

    <h2>
        Neschválené výzvy ({{ $neschvalene_vyzvy->count() }})
    </h2>
    <table class="table table-sm">
        <tr>
            <th>Obsah</th>
            <th>Datum vytvoření</th>
            <th>Vytvořil</th>
        </tr>
        @foreach($neschvalene_vyzvy as $item)
            <tr>
                <td>{{ $item->content }}</td>
                <td>{{ $item->created_at->format('d.m.Y H:i:s') }}</td>
                <td>{{ $item->vytvoril_jmeno() }}</td>
            </tr>
        @endforeach
    </table>

    <h2>
        Uživatelé ({{ $users->count() }})
    </h2>
    <table class="table table-sm">
        <tr>
            <th>Jméno</th>
            <th>Email</th>
            <th>Datum registrace</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d.m.Y H:i:s') }}</td>
            </tr>
        @endforeach
    </table>
@endsection
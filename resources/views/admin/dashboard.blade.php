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
            <th>&nbsp;</th>
        </tr>
        @foreach($neschvalene_vyzvy as $item)
            <tr>
                <td>{{ $item->content }}</td>
                <td>{{ $item->created_at->format('d.m.Y H:i:s') }}</td>
                <td>{{ $item->vytvoril_jmeno() }}</td>
                <td>
                    <a href="javascript:void(0);" data-href="/admin/{{ $item->id }}/delete" onclick="checkSubmit($(this), 'Skutečně si přejete tuto výzvu odstranit?')"><span class="fas fa-times text-danger"></span></a>
                    &nbsp;
                    <a href="javascript:void(0);" data-href="/admin/{{ $item->id }}/approve" onclick="checkSubmit($(this), 'Skutečně si přejete tuto výzvu potvrdit?')"><span class="fas fa-check text-success"></span></a>
                </td>
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

    <script>
        function checkSubmit(e, text) {
            if(confirm(text)) {
                e.attr('href', e.data('href'));
                return true;
            }

            return false;
        }
    </script>
@endsection
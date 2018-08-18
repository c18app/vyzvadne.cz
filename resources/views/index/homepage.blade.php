@extends('layouts.app')

@section('content')
    <h1>Výzva dne</h1>
    <div>
        Na webu je vloženo celkem {{ $vyzev_celkem }} výzev. Pokud máte nápad na novou výzvu, pak jí můžete přidat níže.
    </div>
    <div style="margin-top: 25px; font-weight: bold;">
        vaše dnešní výzva:
    </div>
    <h3>{{ $vyzva }}</h3>
    <div>
        výhody registrace:
    </div>
    <div>
        @if ($errors->any())
            @else
        <button type="button" class="btn btn-success" onclick="$(this).slideUp(); $('form').slideDown();">Chci přidat novou výzvu</button>
        @endif
        <form action="" method="post" style="@if ($errors->any()) @else display: none; @endif">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="content" style="font-weight: bold;">Text výzvy:</label>
                <textarea id="content" name="content" class="form-control">{{ old('content') }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Přidat výzvu</button>
        </form>
    </div>
@endsection
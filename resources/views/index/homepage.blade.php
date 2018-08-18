@extends('layouts.app')

@section('content')
    <h1>Výzva dne</h1>
    <div>
        celkem výzev ({{ $vyzev_celkem }})
    </div>
    <div>
        vaše dnešní výzva:
    </div>
    <div>
        výhody registrace:
    </div>
    <div>
        nová výzva:
        <form action="" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="content">Text výzvy:</label>
                <textarea id="content" name="content" class="form-control">{{ old('content') }}</textarea>
            </div>
            <button type="submit" class="btn">Přidat výzvu</button>
        </form>
    </div>
@endsection
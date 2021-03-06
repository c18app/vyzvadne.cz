@extends('layouts.app')

@section('content')
    <h1>Výzva dne</h1>
    <div>
        Na webu je vloženo celkem {{ $vyzev_celkem }} výzev. Pokud máte nápad na novou výzvu, pak jí můžete přidat níže.
    </div>
    <div class="text-danger">web je nově spuštěn 20. srpna 2018 a není zde ještě dostatek výzev, takže se budou často
        opakovat. Připojte se a přidejte jiné, pro přidání výzvy se <strong>nemusíte registrovat</strong> a výzvu můžete
        <strong>přidat anonymně</strong>.
    </div>
    <div style="margin-top: 25px; font-weight: bold;">
        vaše aktuální výzva:
    </div>
    <h3 class="bg-danger text-light" style="padding: 10px; border-radius: 10px;">{{ $vyzva }}</h3>

    @auth
        <a href="/splneno" class="btn btn-success"><span class="fas fa-check"></span>&nbsp;Tuto výzvu jsem již splnil/a</a>
        <a href="/odlozit" class="btn btn-dark"><span class="fas fa-times"></span>&nbsp;Tato výzva není pro mě, chci
            jinou</a>
    @endauth

    @guest
        <a href="/" class="btn btn-dark"><span class="fas fa-times"></span>&nbsp;Tato výzva není pro mě, chci jinou</a>
    @endguest

    <div style="margin-top: 25px;">
        výhody registrace:
        <ul>
            <li>Můžete odkládat výzvy, které se vám zdají příliš náročné na dobu až budete připraven/a.</li>
            <li>Můžete si odškrtnout výzvu jako splněnou.</li>
            <li>Vidíte historii svých výzev.</li>
        </ul>
    </div>
    <div style="margin-top: 25px;">
        @if ($errors->any())
        @else
            <button type="button" class="btn btn-primary" onclick="$(this).slideUp(); $('form').slideDown();">Chci
                přidat novou výzvu
            </button>
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

    <div style="margin-top: 25px;">
        Skupinu na FB i webovou stránku jsem vytvořil pro všechny, kdo mají rádi výzvy. Na webu se můžete inspirovat a přidat se ke skupině lidí, která se nebojí výzev. Stránka právě vznikla a moc výzev zde není, můžete sami přidávat nové výzvy (a to i anonymně).<br>
        Věřím, že <strong>každé překročení svých hranic nás posune kousek dál</strong>.<br>
        Rady, návody, Vaše příběhy a jiné informace můžete vkládat do skupiny na FB.<br>
        Stále váháte? Přijměte výzvu a zapojte se :)
    </div>

    <div class="text-right" style="margin-top: 25px;">
        <div class="fb-like" data-href="http://www.vyzvadne.cz/" data-layout="button_count" data-action="like"
             data-size="small" data-show-faces="true" data-share="true"></div>
    </div>

    <div class="text-right" style="margin-top: 25px;">
        <div class="fb-group" data-href="https://www.facebook.com/groups/vyzvadne/" data-width="280"
             data-show-social-context="true" data-show-metadata="false"></div>
    </div>
@endsection
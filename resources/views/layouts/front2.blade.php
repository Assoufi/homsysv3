<!DOCTYPE html>
<html lang="fr">
@include('layouts.head')
<body>
<div class="homsys-wrapper">
    @include('layouts.menu')

    <!-- Overlay pour mobile -->
    <div class="nav-overlay"></div>

    @include('layouts.banner')

    {{-- ====================================================
         Bande de notifications — juste après le banner
         Ne perturbe pas le reste du layout
    ===================================================== --}}
    @if (count($errors) > 0 || session()->has('success'))
    <div class="homsys-flash-wrap" id="homsysFlash">

        @if (count($errors) > 0)
        <div class="homsys-flash homsys-flash--error" role="alert">
            <span class="homsys-flash__icon">&#10007;</span>
            <ul class="homsys-flash__list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button class="homsys-flash__close" onclick="this.closest('.homsys-flash').remove()" aria-label="Fermer">&times;</button>
        </div>
        @endif

        @if (session()->has('success'))
        <div class="homsys-flash homsys-flash--success" role="alert">
            <span class="homsys-flash__icon">&#10003;</span>
            <div class="homsys-flash__body">
                @if(is_array(session()->get('success')))
                    <ul class="homsys-flash__list">
                        @foreach (session()->get('success') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @else
                    {{ session()->get('success') }}
                @endif
            </div>
            <button class="homsys-flash__close" onclick="this.closest('.homsys-flash').remove()" aria-label="Fermer">&times;</button>
        </div>
        @endif

    </div>
    @endif
    {{-- ====================================================
         Fin notifications
    ===================================================== --}}

    @yield('content')
    <div class="form-group"></div>
    @include('layouts.footer')
</div>
@include('layouts.scripts')

{{-- Auto-dismiss après 5 secondes --}}
<script>
(function () {
    var wrap = document.getElementById('homsysFlash');
    if (!wrap) return;
    setTimeout(function () {
        wrap.style.transition = 'opacity .5s ease';
        wrap.style.opacity   = '0';
        setTimeout(function () { wrap.remove(); }, 500);
    }, 5000);
})();
</script>

@yield('scripts')
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
</body>
</html>

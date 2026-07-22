<!-- Menu Accessibility & Keyboard Navigation -->
<script src="{{ URL::asset('js/menu-accessibility.js') }}" defer></script>

@if (!Auth::guest())
<!-- Additional Chart Libraries for logged-in users -->
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="{{ URL::asset('script/functions.js') }}"></script>
@endif
@extends('layouts.front2')

@section('titre')
    {!! $meta['title'] !!}
@stop

@section('content')
<div class="homsys-main-section">
    <div class="container">
        <h2 class="mb-4"><i class="fa fa-briefcase"></i> Offres d'emploi IT</h2>
        <livewire:job-search
            :initialKeyword="$keyword ?? ''"
            :initialVille="$ville ?? ''"
            :initialType="$type ?? ''"
        />
    </div>
</div>
@stop

@extends('layouts.front2')

@section('titre')
    {!! $meta['title'] !!}
@stop

@section('content')
<style>
    .offres-page {
        width: 100%;
        max-width: 1100px;
        margin: 0 auto 50px;
        padding: 0 15px;
    }
    .spontane-header {
        margin-bottom: 25px;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
    }
    .spontane-header h3 {
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
    }
    .spontane-header p {
        color: #64748b;
        margin: 8px 0 0;
        font-size: 0.95rem;
    }
    .panel-custom {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        margin-bottom: 25px;
        background: #ffffff;
        overflow: hidden;
    }
    .panel-custom .panel-heading {
        font-weight: 700;
        font-size: 1.1rem;
        color: #007bff;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        border-left: 5px solid #007bff;
        padding: 12px 18px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }
    .panel-custom .panel-body {
        padding: 20px;
    }
</style>

<div class="offres-page">
    <div class="spontane-header">
        <h3><i class="fa fa-briefcase"></i> Offres d'emploi IT</h3>
        <p>Consultez nos dernières opportunités</p>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-search"></i> Rechercher une offre</div>
        <div class="panel-body">
            <livewire:job-search
                :initialKeyword="$keyword ?? ''"
                :initialVille="$ville ?? ''"
                :initialType="$type ?? ''"
            />
        </div>
    </div>
</div>
@stop

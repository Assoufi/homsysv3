@extends('layouts.front2')

@section('titre')
    CV - Live
@stop

@section('content')

<style>
    .cv-page {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto 50px;
        padding: 0 15px;
    }
    .spontane-header {
        margin-bottom: 25px;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .spontane-header h3 {
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
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
    .panel-custom .panel-footer {
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        padding: 12px 18px;
    }
    .btn-submit-blue {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: #ffffff !important;
        font-size: 1.05rem !important;
        font-weight: 700 !important;
        padding: 12px 28px !important;
        border-radius: 5px !important;
        transition: all 0.2s ease-in-out;
        display: inline-block;
        text-decoration: none !important;
        border: none;
        cursor: pointer;
    }
    .btn-submit-blue:hover {
        background-color: #0056b3 !important;
        color: #ffffff !important;
    }
    .btn-outline-gray {
        display: inline-block;
        background: #fff;
        color: #6c757d !important;
        border: 2px solid #cbd5e1;
        font-weight: 700;
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }
    .btn-outline-gray:hover {
        background: #6c757d;
        border-color: #6c757d;
        color: #fff !important;
    }
    .btn-add {
        background: #28a745;
        color: #fff !important;
        border: none;
        font-weight: 600;
        padding: 8px 14px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.2s ease;
    }
    .btn-add:hover {
        background: #1e7e34;
    }
    .btn-remove {
        background: #fff;
        color: #dc3545 !important;
        border: 1px solid #dc3545;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.85rem;
        margin-top: 8px;
    }
    .btn-remove:hover {
        background: #dc3545;
        color: #fff !important;
    }
    .live-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 14px;
        margin-bottom: 12px;
    }
    .live-item .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        box-shadow: none;
        height: auto;
        padding: 9px 12px;
        margin-bottom: 8px;
    }
    .live-item .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.12);
    }
</style>

<div class="cv-page">
    <div class="spontane-header">
        <h3><i class="fa fa-keyboard-o"></i> CV en ligne</h3>
        <a href="{{ url('/candidats/cv/') }}" class="btn-outline-gray">
            <i class="fa fa-arrow-left"></i> Retour
        </a>
    </div>

    <form method="post" action="{{ url('/candidats/cv/live') }}" id="live-cv-form">
        @csrf

        <div class="panel panel-custom">
            <div class="panel-heading"><i class="fa fa-briefcase"></i> Expériences professionnelles</div>
            <div class="panel-body" id="experiences-container">
                <div class="live-item experience-item">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" class="form-control experience-titre" placeholder="Intitulé de l'expérience" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control experience-organisme" placeholder="Organisme / Entreprise">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control experience-date" placeholder="Période (ex: 2020-2023)">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="button" class="btn-add" onclick="addExperience()">
                    <i class="fa fa-plus"></i> Ajouter une expérience
                </button>
            </div>
        </div>

        <div class="panel panel-custom">
            <div class="panel-heading"><i class="fa fa-cogs"></i> Technologies</div>
            <div class="panel-body" id="technologies-container">
                <div class="live-item technology-item">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control technology-titre" placeholder="Technologie / Langage" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control technology-projet" placeholder="Projet associé">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="button" class="btn-add" onclick="addTechnology()">
                    <i class="fa fa-plus"></i> Ajouter une technologie
                </button>
            </div>
        </div>

        <input type="hidden" name="live_cv" id="live_cv_input">

        <div class="text-center" style="margin: 10px 0 30px;">
            <button type="submit" class="btn btn-submit-blue">
                <i class="fa fa-floppy-o"></i> Enregistrer le CV
            </button>
        </div>
    </form>
</div>

<script>
function addExperience() {
    const container = document.getElementById('experiences-container');
    const newItem = document.createElement('div');
    newItem.className = 'live-item experience-item';
    newItem.innerHTML = `
        <div class="row">
            <div class="col-md-5">
                <input type="text" class="form-control experience-titre" placeholder="Intitulé de l'expérience">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control experience-organisme" placeholder="Organisme / Entreprise">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control experience-date" placeholder="Période (ex: 2020-2023)">
            </div>
        </div>
        <button type="button" class="btn-remove" onclick="this.closest('.experience-item').remove()">
            <i class="fa fa-minus"></i> Supprimer
        </button>
    `;
    container.appendChild(newItem);
}

function addTechnology() {
    const container = document.getElementById('technologies-container');
    const newItem = document.createElement('div');
    newItem.className = 'live-item technology-item';
    newItem.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control technology-titre" placeholder="Technologie / Langage">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control technology-projet" placeholder="Projet associé">
            </div>
        </div>
        <button type="button" class="btn-remove" onclick="this.closest('.technology-item').remove()">
            <i class="fa fa-minus"></i> Supprimer
        </button>
    `;
    container.appendChild(newItem);
}

document.getElementById('live-cv-form').addEventListener('submit', function () {
    const experiences = [];
    document.querySelectorAll('.experience-item').forEach(item => {
        const titre = item.querySelector('.experience-titre')?.value.trim();
        if (titre) {
            experiences.push({
                titre: titre,
                organisme: item.querySelector('.experience-organisme')?.value.trim() || '',
                date: item.querySelector('.experience-date')?.value.trim() || ''
            });
        }
    });

    const technologies = [];
    document.querySelectorAll('.technology-item').forEach(item => {
        const titre = item.querySelector('.technology-titre')?.value.trim();
        if (titre) {
            technologies.push({
                titre: titre,
                projet: item.querySelector('.technology-projet')?.value.trim() || ''
            });
        }
    });

    document.getElementById('live_cv_input').value = JSON.stringify({
        experiences: experiences,
        technologies: technologies
    });
});
</script>

@stop

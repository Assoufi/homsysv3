@extends('layouts.front2')
@section('titre')
    CV - Live
@stop
@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="d-flex align-items-center">
                <i class="fa fa-keyboard-o mr-2"></i> CV en ligne
                <a href="{{ url('/candidats/cv/') }}" class="btn btn-outline-secondary ml-auto">
                    <i class="fa fa-backward"></i> Retour
                </a>
            </h2>
        </div>
    </div>

    <form method="post" action="{{ url('/candidats/cv/live') }}" id="live-cv-form">
        @csrf
        
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fa fa-briefcase mr-2"></i> Expériences professionnelles</h5>
            </div>
            <div class="card-body" id="experiences-container">
                <div class="row mb-3 experience-item">
                    <div class="col-md-5">
                        <input type="text" class="form-control experience-titre" placeholder="Intitulé de l'expérience" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control experience-organisme" placeholder="Organisme / Entreprise">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control experience-date" placeholder="Période (ex: 2020-2023)">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-sm btn-success" onclick="addExperience()">
                    <i class="fa fa-plus mr-1"></i> Ajouter une expérience
                </button>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fa fa-keyboard-o mr-2"></i> Technologies</h5>
            </div>
            <div class="card-body" id="technologies-container">
                <div class="row mb-3 technology-item">
                    <div class="col-md-5">
                        <input type="text" class="form-control technology-titre" placeholder="Technologie / Langage" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control technology-projet" placeholder="Projet associé">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-sm btn-success" onclick="addTechnology()">
                    <i class="fa fa-plus mr-1"></i> Ajouter une technologie
                </button>
            </div>
        </div>

        <input type="hidden" name="live_cv" id="live_cv_input">
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fa fa-floppy-o mr-2"></i> Enregistrer le CV
            </button>
        </div>
    </form>
</div>

<script>
function addExperience() {
    const container = document.getElementById('experiences-container');
    const newItem = document.createElement('div');
    newItem.className = 'row mb-3 experience-item';
    newItem.innerHTML = `
        <div class="col-md-5">
            <input type="text" class="form-control experience-titre" placeholder="Intitulé de l'expérience">
        </div>
        <div class="col-md-5">
            <input type="text" class="form-control experience-organisme" placeholder="Organisme / Entreprise">
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control experience-date" placeholder="Période (ex: 2020-2023)">
        </div>
        <div class="col-md-12 mt-2">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.experience-item').remove()">
                <i class="fa fa-minus"></i> Supprimer
            </button>
        </div>
    `;
    container.appendChild(newItem);
}

function addTechnology() {
    const container = document.getElementById('technologies-container');
    const newItem = document.createElement('div');
    newItem.className = 'row mb-3 technology-item';
    newItem.innerHTML = `
        <div class="col-md-5">
            <input type="text" class="form-control technology-titre" placeholder="Technologie / Langage">
        </div>
        <div class="col-md-5">
            <input type="text" class="form-control technology-projet" placeholder="Projet associé">
        </div>
        <div class="col-md-2 mt-2">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.technology-item').remove()">
                <i class="fa fa-minus"></i> Supprimer
            </button>
        </div>
    `;
    container.appendChild(newItem);
}

document.getElementById('live-cv-form').addEventListener('submit', function(e) {
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
@extends('layouts.front2')

@section('titre')
    {!! $meta['title'] !!}
@stop

@section('content')

<style>
    .contact-page {
        width: 100%;
        max-width: 1000px;
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
    .contact-info-list {
        list-style: none;
        padding: 0;
        margin: 0 0 18px;
    }
    .contact-info-list li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #e2e8f0;
        color: #475569;
        line-height: 1.5;
    }
    .contact-info-list li:last-child {
        border-bottom: none;
    }
    .contact-info-list li i {
        color: #007bff;
        width: 20px;
        text-align: center;
        margin-top: 3px;
        flex-shrink: 0;
    }
    .contact-info-list a {
        color: #007bff;
        font-weight: 600;
    }
    .contact-social {
        margin: 16px 0 20px;
    }
    .contact-social a {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        border-radius: 8px;
        background: #e8f1ff;
        color: #007bff;
        margin-right: 8px;
        font-size: 1.1rem;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .contact-social a:hover {
        background: #007bff;
        color: #fff;
    }
    .contact-map {
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        line-height: 0;
    }
    .contact-map iframe {
        width: 100%;
        height: 220px;
        border: 0;
    }
    .contact-form .form-group {
        margin-bottom: 16px;
    }
    .contact-form label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 6px;
        display: block;
    }
    .contact-form .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        box-shadow: none;
        height: auto;
        padding: 10px 12px;
    }
    .contact-form .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.12);
    }
    .contact-form textarea.form-control {
        min-height: 140px;
        resize: vertical;
    }
    .btn-submit-blue {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: #ffffff !important;
        font-size: 1.05rem !important;
        font-weight: 700 !important;
        padding: 12px 35px !important;
        border-radius: 5px !important;
        transition: all 0.2s ease-in-out;
        border: none;
        cursor: pointer;
    }
    .btn-submit-blue:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        color: #ffffff !important;
    }
</style>

<div class="contact-page">
    <div class="spontane-header">
        <h3>Contactez-nous</h3>
        <p>N’hésitez pas à nous contacter pour tout renseignement concernant nos services</p>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-map-marker"></i> Informations de contact</div>
                <div class="panel-body">
                    <ul class="contact-info-list">
                        <li>
                            <i class="fa fa-map-marker"></i>
                            <span>2, Angle Bd Youssef Ibn Tachafine et rue Zineb Ishak, N° 07 — Casablanca</span>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <span>Email : <a href="mailto:contact@homsys.ma">contact@homsys.ma</a></span>
                        </li>
                    </ul>

                    <div class="contact-social">
                        <a href="https://www.linkedin.com/company/homsys-maroc/" target="_blank" title="LinkedIn" rel="noopener">
                            <i class="fa fa-linkedin"></i>
                        </a>
                        <a href="https://www.facebook.com/Homsys-230140987182373/" target="_blank" title="Facebook" rel="noopener">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="https://twitter.com/HomsysMaroc" target="_blank" title="Twitter" rel="noopener">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </div>

                    <div class="contact-map">
                        <iframe src="https://maps.google.com/maps?hl=fr&amp;q=2%20rue%20zineb%20ishak%20casablanca&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" loading="lazy" title="Localisation HOMSYS"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-paper-plane"></i> Nous voulons vous entendre</div>
                <div class="panel-body">
                    <form action="{{ url('mails/contact') }}" method="post" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Votre nom <span class="text-danger">*</span></label>
                                <input id="name" name="name" type="text" class="form-control" required maxlength="100" placeholder="Ex: Jean Dupont" value="{{ old('name') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="email">Votre email <span class="text-danger">*</span></label>
                                <input id="email" name="email" type="email" class="form-control" required maxlength="100" placeholder="Ex: jean.dupont@example.com" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="sujet">Sujet <span class="text-danger">*</span></label>
                                <input id="sujet" name="sujet" type="text" class="form-control" required maxlength="150" placeholder="Objet de votre message" value="{{ old('sujet') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="tel">Téléphone</label>
                                <input id="tel" name="tel" type="tel" class="form-control" maxlength="30" placeholder="Ex: 0612345678" value="{{ old('tel') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="texto">Votre message <span class="text-danger">*</span></label>
                            <textarea id="texto" name="message" class="form-control" required maxlength="3000" placeholder="Écrivez votre message ici…">{{ old('message') }}</textarea>
                        </div>
                        <div class="text-center" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-submit-blue">
                                <i class="fa fa-paper-plane"></i> Envoyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

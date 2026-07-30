<header id="homsys-header" class="homsys-header-one">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-md-2 col-6">
                <a href="{{ url('/') }}" class="homsys-logo">
                    <img src="{{ URL::asset('img/logo.png') }}" height="60" alt="Logo HOMSYS">
                </a>
            </div>

            <!-- Menu Burger pour mobile -->
            <div class="col-6 d-md-none text-end">
                <button class="mobile-menu-toggle" aria-label="Menu" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>
            </div>

            <!-- Navigation -->
            <div class="col-md-10">
                <nav class="homsys-nav" id="main-nav" role="navigation" aria-label="Menu principal">
                    <ul class="main-menu" role="menubar">
                        <!-- Accueil -->
                        <li class="menu-item {{ Request::is('/') ? 'active' : '' }}" role="none">
                            <a href="{{ url('/') }}" role="menuitem">Accueil</a>
                        </li>

                        <!-- Candidats (avec sous-menu) -->
                        <li class="menu-item menu-item-has-children" role="none">
                            <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">
                                Candidats <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                            </a>
                            <ul class="sub-menu" role="menu" aria-label="Sous-menu Candidats">
                                <li role="none"><a href="{{ url('offres') }}" role="menuitem">Consulter les offres</a></li>
                                <li role="none"><a href="{{ url('logins') }}" role="menuitem">Mon Compte</a></li>
                                <li role="none"><a href="{{ url('candidats/spontane') }}" role="menuitem">Candidature spontanée</a></li>
                                <li role="none"><a href="{{ url('/portage') }}" role="menuitem">Portage Salarial</a></li>
                            </ul>
                        </li>

                        <!-- A propos (avec sous-menu) -->
                        <li class="menu-item menu-item-has-children" role="none">
                            <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">
                                A propos <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                            </a>
                            <ul class="sub-menu" role="menu" aria-label="Sous-menu A propos">
                                <li role="none"><a href="{{ url('/about') }}" role="menuitem">Qui-sommes-nous</a></li>
                                <li role="none"><a href="{{ url('/about') }}#service" role="menuitem">Nos Services</a></li>
                                <li role="none"><a href="{{ url('/about') }}#valeurs" role="menuitem">Nos valeurs</a></li>
                                <li role="none"><a href="{{ url('/about') }}#methodologie" role="menuitem">Notre Méthodologie</a></li>
                                <li role="none"><a href="{{ url('mails/contactus') }}" role="menuitem">Contact</a></li>
                            </ul>
                        </li>

                        <!-- Offres -->
                        <li class="menu-item {{ Request::is('offres') ? 'active' : '' }}" role="none">
                            <a href="{{ url('offres') }}" role="menuitem">Offres</a>
                        </li>

                        <!-- Contact -->
                        <li class="menu-item {{ Request::is('mails/contactus') ? 'active' : '' }}" role="none">
                            <a href="{{ url('mails/contactus') }}" role="menuitem">Contact</a>
                        </li>

                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li class="menu-item" role="none">
                                <a href="{{ url('logins') }}" role="menuitem">
                                    <i class="fa fa-btn fa-sign-in"></i> Connexion
                                </a>
                            </li>
                            <li class="menu-item" role="none">
                                <a href="{{ url('candidats/create') }}" role="menuitem">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i> S'inscrire
                                </a>
                            </li>
                        @else
                            @if (Auth::user()->hasRole('admin'))
                                <li class="menu-item" role="none">
                                    <a href="{{ url('/admin/index') }}" role="menuitem">
                                        <i class="fa fa-tachometer" aria-hidden="true"></i> Tableau de bord
                                    </a>
                                </li>
                            @else
                                <li class="menu-item" role="none">
                                    <a href="{{ url('/candidats/index') }}" role="menuitem">
                                        <i class="fa fa-tachometer" aria-hidden="true"></i> Tableau de bord
                                    </a>
                                </li>
                            @endif

                            <li class="menu-item menu-item-has-children" role="none">
                                <a href="#" role="menuitem" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user" aria-hidden="true"></i> 
                                    {{ strtoupper(Auth::user()->username) }} 
                                    <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                                </a>
                                <ul class="sub-menu" role="menu" aria-label="Menu utilisateur">
                                    <li role="none">
                                        <a href="{{ url('password/change') }}" role="menuitem">
                                            <i class="fa fa-key"></i> Modifier le mot de passe
                                        </a>
                                    </li>
                                    <li role="none">
                                        <a href="{{ route('logout') }}" role="menuitem" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-btn fa-sign-out"></i> Déconnexion
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
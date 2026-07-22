<!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <title>HOMSYS : Faites le choix d'un partenaire fiable</title>
    @include('css_js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

@include('navbar')

<section id="top_content" class="top_cont_outer">
    <div class="top_cont_inner">
        <div class="container">
            <div class="top_content">
                <div class="row">
                    <div align="center" >
                        <div class="top_left_cont flipInY wow animated">
                            <h3>Bienvenue à l'espace recrutement HOMSYS</h3>
                            <h2>Notre entreprise</h2>
                            <p align="justify"> HOMSYS est une SSII à forte expertise technique en informatique. Elle cultive son leadership dans l'intégration de solutions qu'elle développe elle-même, ou bien avec des partenaires.
                                Notre mission est de concevoir et de mettre en oeuvre des solutions informatiques adaptées aux besoins de nos clients. </p>
                            <a href="{{url('offres')}}" class="btn btn-warning">Nos offres</a> </div><br>
                    </div>
                    <div class="col-lg-7 col-sm-5"> </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Top_content-->

<!--Service-->
<section  id="entreprise">
    <div class="container">
        <h2>Entreprise</h2>
        <div class="service_area">
            <div class="row col-lg-12">
                <div class="col-lg-4">
                    <div class="service_block">
                        <div class="service_icon delay-03s animated wow  zoomIn"> <span><i class="fa-flash"></i></span> </div>
                        <h3 class="animated fadeInUp wow">Entreprise</h3>
                        <p class="animated fadeInDown wow" style="text-align: justify;">HOMSYS est une SSII à forte expertise technique en informatique. Elle cultive son leadership dans l'intégration de solutions qu'elle développe elle-même, ou bien avec des partenaires.
                            Notre mission est de concevoir et de mettre en oeuvre des solutions informatiques adaptées aux besoins de nos clients. </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service_block">
                        <div class="service_icon icon2  delay-03s animated wow zoomIn"> <span><i class="fa-comments"></i></span> </div>
                        <h3 class="animated fadeInUp wow">Qui sommes-nous ?</h3>
                        <p class="animated fadeInDown wow"  style="text-align: justify;">HOMSYS intervient dans les domaines de services informatiques, de conseils, de formations. Elle est également éditeur de logiciels de haute technologie. Nous intervenons durant tout le cycle de la vie d’un projet. Nos prestations couvrent aussi bien le recueil des besoins, qu’ils soient opérationnels, comptables ou réglementaires, la mise en œuvre des solutions, la formation des utilisateurs et la conduite du changement. Animés d’un même sens du service, tous nos consultants vous accompagnent dans les étapes de réflexion, de conception, de mise en œuvre et d’optimisation de vos systèmes d’information pour le bon fonctionnement de vos processus métiers.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service_block">
                        <div class="service_icon icon3  delay-03s animated wow zoomIn"> <span><i class="fa-shield"></i></span> </div>
                        <h3 class="animated fadeInUp wow">Nos valeurs</h3>
                        <div class="animated fadeInDown wow" style="text-align: justify;"><p><b>L’esprit d’équipe</b></p>
                            <p>L’écoute, le dialogue, la confrontation des analyses pour cultiver la diversité des talents et des cultures. C’est la force de l’entreprise : être encore plus efficace ensemble.</p>
                            <p><b>La transparence</b></p>
                            <p>La transparence nous amène à agir et à décider ouvertement. Elle assure le respect éthique et déontologique à ceux qui nous font confiance.</p>
                            <p><b>Expertise et accompagnement</b></p>
                            <p>Fort de l’expérience et de l’expertise de ses équipes, HOMSYS apporte à ses clients un accompagnement global de leurs projets.
                            Nous adaptons notre accompagnement à votre structure et à votre métier, pour répondre à vos besoins et pour faire face à l’accroissement des exigences réglementaires, comptables, fiscales et technologiques.
                            HOMSYS vous conseille et vous assiste dans vos réflexions jusqu’à la mise en œuvre de vos projets d’évolution et/ou d’amélioration de la performance de votre organisation ou de votre système d’information.</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Service-->

<!--
<section id="portage">
    <div class="top_cont_latest">
        <div class="container">
            <h2>Portage</h2>
            <div class="work_section">
                <div class="row" align="justify">
                    <div class="wow fadeInLeft delay-05s col-lg-12">
                        <div class="service-list">
                            <div class="service-list-col1"> <i class="icon-doc"></i> </div>
                            <div class="service-list-col2">
                                <h3>Le concept</h3>
                                <p style="text-align: justify;">Le portage salarial est un ensemble de relations contractuelles organisées entre une entreprise de portage, une personne portée et des entreprises clientes comportant pour la personne portée le régime du salariat et la rémunération de sa prestation chez le client par l'entreprise de portage.<br>
                                    Autrement dit, vous assurez une prestation pour une société cliente et nous gèrons pour vous les démarches administratives et la facturation avec cette société.</p>
                            </div>
                        </div>
                        <div class="service-list">
                            <div class="service-list-col1"> <i class="icon-comment"></i> </div>
                            <div class="service-list-col2">
                                <h3>Les Avantages du portage salarial</h3>
                                <ul style="list-style-type:disc">
                                    <li>Cr&eacute;er son activit&eacute; sans cr&eacute;er de structure juridique. Avec nos tarifs, il est moins cher de passer par notre portage que de créer sa propre structure</li>
                                    <li>Constituer et conserver sa propre client&egrave;le</li>
                                    <li>Se consacrer exclusivement &agrave; son m&eacute;tier</li>
                                    <li>G&eacute;rer son emploi du temps en harmonie avec sa vie sociale</li>
                                    <li>Valoriser son image</li>
                                    <li>Ne pas perdre de temps sur des t&acirc;ches administratives,&nbsp;comptables, fiscales etc.</li>
                                    <li>Ne pas risquer son patrimoine personnel</li>
                                    <li>B&eacute;n&eacute;ficier du statut salarial (S&eacute;curit&eacute; sociale, pr&eacute;voyance, retraite, et l&#39;assurance ch&ocirc;mage)</li>
                                    <li>Transformer le handicap de l&#39;&acirc;ge en atout (l&#39;exp&eacute;rience est valoris&eacute;e pour un consultant)</li>
                                    <li>Int&eacute;grer la dynamique d&#39;un r&eacute;seau d&#39;experts</li>
                                    <li>B&eacute;n&eacute;ficier d&#39;une assurance responsabilit&eacute; civile professionnelle</li>
                                    <li>En passant par notre service de portage, vous aurez la priorit&eacute; sur toutes nos offres de missions</li>
                                    <li>Par téléphone ou par email, vous pouvez joindre votre interlocuteur chez HOMSYS. Vous bénéficiez d’un échange permanent pour répondre à toutes vos attentes. Cette relation privilégiée est pour nous une priorité</li>
                                    <li><span style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight: bold">Aucun minimum de chiffre d’affaires</span> Vous pouvez profiter de notre solution sans aucun minimum de chiffre d’affaires à réaliser. Souple et flexible, notre modèle vous permet de vous lancer à votre rythme. D’un mois à l’autre, le montant de vos factures peut varier et vous pouvez rester inactif, sans aucune limite de durée et sans coût supplémentaire</li>
                                    <li><span style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight: bold">Gestion administrative et comptable</span> Emission des salaires, versement des charges et taxes aux différentes caisses, HOMSYS assure pour vous toute la gestion comptable et administrative de votre activité</li>
                                </ul>
                            </div>
                        </div>
                        <div class="service-list">
                            <div class="service-list-col1"> <i class="icon-database"></i> </div>
                            <div class="service-list-col2">
                                <h3>LE FONCTIONNEMENT DU PORTAGE SALARIAL CHEZ HOMSYS</h3>
                                <p><b>UNE ORGANISATION SIMPLIFIÉE AVEC LE PORTAGE SALARIAL</b></p>
                                <ul style="list-style-type:disc">
                                    <li>Vous réalisez une mission en portage auprès de votre client</li>
                                    <li>HOMSYS facture à l'entreprise les honoraires que vous avez négociés au préalable et selon vos indications et conditions de vente</li>
                                    <li>HOMSYS gère également les règlements dès leur réception et vous facilite la gestion de la relation commerciale (gestion des relances, de trésorerie...)</li>
                                    <li>HOMSYS vous embauche en tant que salarié et assume la relation employeur / employé : nous vous versons un salaire et vous assurons tous les avantages du statut, notamment les couvertures responsabilité civile professionnelle, sociales, retraites, prévoyance et accidents.
                                        Tout devient beaucoup plus simple avec le portage salarial</li>
                                </ul>
                                <p><b>DES FORMALITÉS RÉDUITES</b></p>
                                <p>Pour adhérer à notre service de portage salarial, il vous suffit :</p>
                                <ul style="list-style-type:disc">
                                    <li>d'être d'accord avec votre client sur l'objet et les conditions d'un contrat de mission en portage salarial</li>
                                    <li>de signer le Contrat de Travail qui fixe les règles de notre collaboration.
                                        Aussi, les formalités de gestion comptable, juridique et sociale et les déclarations aux différents organismes sont réalisées par HOMSYS</li>
                                </ul>
                            </div>
                        </div>
                        <div class="service-list">
                            <div class="service-list-col1"> <i class="icon-cog"></i> </div>
                            <div class="service-list-col2">
                                <h3>QUI EST ELIGIBLE ?</h3>
                                <ul style="list-style-type:disc">
                                    <li><b>Vous êtes indépendant </b>et vous souhaitez vous consacrer exclusivement à votre activité d’indépendant.</li>
                                    <li><b>Vous êtes étudiant </b>et vous souhaitez exercer une activité en parallèle.</li>
                                    <li><b>Vous êtes salarié et vous souhaitez exercer une activité en complément de votre emploi.</b></li>
                                    <li><b>Vous êtes retraité </b>et vous souhaitez travailler pour compléter votre pension. </li>
                                    <li><b>Vous cherchez une alternative pour travailler </b>en définissant vous-même vos plannings, vos tarifs, vos lieux de travail.</li>
                                    <li><b>Vous êtes un webmaster ou bloggeur </b>et vous gagnez des revenus grâce à vos sites internet. </li>
                                    <li><b>Vous êtes à la recherche d’un emploi</b></li>
                                </ul>
                            </div>
                        </div>
                       {{--}} <div class="work_bottom"> <span>Ready to take the plunge?</span> <a href="#contact" class="contact_btn">Contact Us</a> </div>{{--}}
                    </div>
                    <figure class="col-lg-6 col-sm-6  text-right wow fadeInUp delay-02s"> </figure>
                </div>
            </div>
        </div>
    </div>
</section>
-->
<!--main-section-end-->

<!--new_services-->

<!-- services -->
<section id="services"><!--main-section-start-->
    <div class="top_cont_latest">
        <div class="container">
            <h2>Service</h2>
            <div class="work_section">
                <div class="row" align="justify">
                    <div class="wow fadeInLeft delay-05s col-lg-12">
                        <div class="service-list">
                            <div class="service-list-col1"> <i class="icon-doc"></i> </div>
                            <div class="service-list-col2">
                                <h3>Conseil</h3>
                                <p>Des équipes d’ingénieurs, consultants et chefs de projet composées d’experts et de spécialistes sont répliquées dans les différents centres de compétences. Elles sont spécialisées dans la maîtrise d’œuvre des projets en avant vente, la conception et le développement d’applications, le conseil, l’intégration des systèmes et la mise en œuvre des produits commercialisés par HOMSYS.<br />
                                    Issue d’une expérience approuvée et de la pratique de standards et référentiels (MSF Microsoft Solutions Framework , PMI Project Management Institute), la démarche de HOMSYS repose donc sur une double maîtrise :
                                    La maîtrise de processus spécifiques aux projets d’architecture et de déploiement d’infrastructures.
                                    La maîtrise de processus standards de pilotage de projet, indispensables à tout type de projet.<br/>
                                    HOMSYS vous accompagne :<br/>
                                <ul style="list-style-type:disc">
                                    <li>MOE / AMOE : Pilotage de projet : Organisation et pilotage, planification et outils de suivi, animation de projet, assistance aux choix techniques, suivi budgétaire, chiffrage</li>
                                    <li>MOA / AMOA : accompagnement à la rédaction de cahier des charges / spécifications fonctionnelles</li>
                                    <li>Accompagnement à l’externalisation du système d’information</li>
                                    <li>Accompagnement au changement pour les utilisateurs ou les administrateurs (migration Des systèmes)</li>
                                    <li>Encadrement d'équipe technique et de consultants</li>
                                </ul>
                                </p>
                            </div>
                        </div>
                        <div class="service-list">
                            <div class="service-list-col1"> <i class="icon-comment"></i> </div>
                            <div class="service-list-col2">
                                <h3>Développement</h3>
                                <p>HOMSYS est connue par son expertise en développement et intégration des solutions informatique. Forte de son expérience et des compétences de ses collaborateurs, HOMSYS vous offre une perspicacité technique d'expertise et d'administration...<br />
                                    Nous apercevons la technologie dans le contexte des besoins et des attentes, et nous savons orienter et aider les entreprises à mieux gérer leur travail en toute efficacité et efficience. De ce fait, notre entreprise intervient souvent dans des développements spécifiques, avec intégration partielle ou totale des solutions du marché, de haute technologie, pour mettre en place la solution correspondant parfaitement au cahier des charges de nos clients.<br/>
                                    HOMSYS propose à ses client sont savoir faire à partir de la définition des besoins jusqu'au déploiement en passant par la conception, développement et test des projets <strong>Desktop, Web, Mobile et Tablette</strong>
                                </p>
                            </div>
                        </div>


                        {{--}} <div class="work_bottom"> <span>Ready to take the plunge?</span> <a href="#contact" class="contact_btn">Contact Us</a> </div>{{--}}
                    </div>
                    <figure class="col-lg-6 col-sm-6  text-right wow fadeInUp delay-02s"> </figure>
                </div>
            </div>
        </div>
        <!--<div class="work_pic"><img src="img/dashboard_pic.png" alt=""></div>-->
    </div>
</section>
<!--/services -->

<!--new_services-->

<!--
<section class="main-section paddind" id="services">
    <div class="container">
        <h2>services</h2>
        <h6>Fresh services of designs that will keep you wanting more.</h6>
    </div>


</section>

-->
<!--
<section class="main-section" id="produits">
    <h2>Produits</h2>
    <div class="client_area ">
        <div class="client_section animated  fadeInUp wow">
            <div class="client_profile">
                <img src="img/assafwa.png" class="img-circle" height="220" width="220" alt="">>
                <h3>ASSAFWA - RENT</h3>
                 </div>
            <div class="quote_section">
                <div class="quote_arrow"></div>
                <p> <p>ASSAFWA - RENT est une solution compléte destinée aux agences de location de voitures, elle fonctionne sous les différents systèmes d'exploitation.
                    Simple à utiliser et adaptée à vos besoins.
                    ASSAFWA - RENT s’adresse aux loueurs de véhicules de tourisme , et de poids lourds courte et longue durée.
                    C’est un outil informatique complet, fiable et évolutif qui vous permettra d’être toujours à jour et ainsi de vous centrer sur votre activité de location.
                    <a href="https://www.assafwa-dev.com" target="_blank">En Savoir Plus...</a>
                </p>  </p>
            </div>
            <div class="clear"></div>
        </div>
        <br><br><br>
    </div>
</section>
-->


<!--twitter-feed-end-->
<footer class="footer_sections" id="contact">
    <div class="container">
        <section class="main-section contact" id="contact">
            <div class="contact_section">
                <h2>Contactez nous</h2>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="contact_block">
                            <div class="contact_block_icon icon3 rollIn animated wow"><span><i class="fa-pencil"></i></span></div>
                            <span> <a href="mailto:contact@homsys.ma">  contact@homsys.ma</a> </span> </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 wow fadeInLeft">
                    <div class="contact-info-box address clearfix">
                        <h3>Pour nous cantacter</h3>
                        <p align="justify">Pour toute demande d’information ou si vous souhaitez être contacté par nos services, veuillez remplir et valider le formulaire ci-dessous (les zones précédées du symbole * sont obligatoires).</p>
                    </div>

                </div>
                <div class="col-lg-6 wow fadeInUp delay-06s">
                    <form action="{{url('mails/contact')}}" method="post">
                        @csrf
                        <div class="form">
                            <p style="color:red;"> {{Session::get('captcha')}}</p>
                            <input class="input-text animated wow flipInY delay-02s" type="text" name="name" placeholder="Nom *" onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" required>
                            <input class="input-text animated wow flipInY delay-04s" type="text" name="email" placeholder="Email *" onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" required>
                            <p style="color:white;"> Votre Message *</p>
                            <textarea class="input-text text-area animated wow flipInY delay-06s" name="message" cols="0" rows="0" onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;"></textarea>
                            <!--<div class="g-recaptcha" data-sitekey="6Ld6iWEUAAAAAH25IZRpEjHhh8BdfylYMz98PtKl"></div>-->
                            <input class="input-btn animated wow flipInY delay-04s" type="submit" value="ENVOYER">
                        </div>
                    </form>
                </div>
            </div>

        </section>
    </div>
    <div class="container">
        <div class="footer_bottom">

            <span>LinkedIn | <a href="#" class="fa fa-linkedin"></a>  </span>
            <span>Facebook | <a href="#" class="fa fa-facebook"></a>  </span>
        </div>
        <!--
            All links in the footer should remain intact.
            Licenseing information is available at: http://bootstraptaste.com/license/
            You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=Butterfly
        -->
    </div>
</footer>

<script type="text/javascript">
    $(document).ready(function(e) {
        $('#header_outer').scrollToFixed();
        $('.res-nav_click').click(function(){
            $('.main-nav').slideToggle();
            return false

        });

    });
</script>
<script>
    wow = new WOW(
            {
                animateClass: 'animated',
                offset:       100
            }
    );
    wow.init();
    document.getElementById('').onclick = function() {
        var section = document.createElement('section');
        section.className = 'wow fadeInDown';
        section.className = 'wow shake';
        section.className = 'wow zoomIn';
        section.className = 'wow lightSpeedIn';
        this.parentNode.insertBefore(section, this);
    };
</script>
<script type="text/javascript">
    $(window).load(function(){

        $('a').bind('click',function(event){
            var $anchor = $(this);

            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 91
            }, 1500,'easeInOutExpo');
            /*
             if you don't want to use the easing effects:
             $('html, body').stop().animate({
             scrollTop: $($anchor.attr('href')).offset().top
             }, 1000);
             */
            event.preventDefault();
        });
    })
</script>

<!--<script type="text/javascript">

$(window).load(function(){


  var $container = $('.servicesContainer'),
      $body = $('body'),
      colW = 350,
      columns = null;


  $container.isotope({
    // disable window resizing
    resizable: true,
    masonry: {
      columnWidth: colW
    }
  });

  $(window).smartresize(function(){
    // check if columns has changed
    var currentColumns = Math.floor( ( $body.width() -30 ) / colW );
    if ( currentColumns !== columns ) {
      // set new column count
      columns = currentColumns;
      // apply width to container manually, then trigger relayout
      $container.width( columns * colW )
        .isotope('reLayout');
    }

  }).smartresize(); // trigger resize to set container width
  $('.servicesFilter a').click(function(){
        $('.servicesFilter .current').removeClass('current');
        $(this).addClass('current');

        var selector = $(this).attr('data-filter');
        $container.isotope({

            filter: selector,
         });
         return false;
    });

});

</script>


-->

<script type="text/javascript">


    jQuery(document).ready(function($){
// services Isotope
        var container = $('#services-wrap');


        container.isotope({
            animationEngine : 'best-available',
            animationOptions: {
                duration: 200,
                queue: false
            },
            layoutMode: 'fitRows'
        });

        $('#filters a').click(function(){
            $('#filters a').removeClass('active');
            $(this).addClass('active');
            var selector = $(this).attr('data-filter');
            container.isotope({ filter: selector });
            setProjects();
            return false;
        });


        function splitColumns() {
            var winWidth = $(window).width(),
                    columnNumb = 1;


            if (winWidth > 1024) {
                columnNumb = 4;
            } else if (winWidth > 900) {
                columnNumb = 2;
            } else if (winWidth > 479) {
                columnNumb = 2;
            } else if (winWidth < 479) {
                columnNumb = 1;
            }

            return columnNumb;
        }

        function setColumns() {
            var winWidth = $(window).width(),
                    columnNumb = splitColumns(),
                    postWidth = Math.floor(winWidth / columnNumb);

            container.find('.services-item').each(function () {
                $(this).css( {
                    width : postWidth + 'px'
                });
            });
        }

        function setProjects() {
            setColumns();
            container.isotope('reLayout');
        }

        container.imagesLoaded(function () {
            setColumns();
        });


        $(window).bind('resize', function () {
            setProjects();
        });

    });
    $( window ).load(function() {
        jQuery('#all').click();
        return false;
    });
</script>
</body>
</html>

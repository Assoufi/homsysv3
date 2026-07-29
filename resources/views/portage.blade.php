@extends('layouts.front')

@section('titre')
    Portage Salarial
@stop
@section('content')

<section id="portage">
    <div class="top_cont_latest">
        <div class="container">
            <h2>Portage Salarial</h2>
            <div class="work_section">
                <div class="row" align="justify">
                    <div class="wow fadeInLeft delay-05s col-lg-12">
                        <!-- 1. Demande de Simulation & Concept -->
                        <div class="service-list">
                            <div class="service-list-col1"> <i class="icon-doc"></i> </div>
                            <div class="service-list-col2">
                                <h3>Le concept</h3>
                                <p style="text-align: justify;">Le portage salarial est un ensemble de relations contractuelles organisées entre une entreprise de portage, une personne portée et des entreprises clientes comportant pour la personne portée le régime du salariat et la rémunération de sa prestation chez le client par l'entreprise de portage.<br>
                                Autrement dit, vous assurez une prestation pour une société cliente et nous gérons pour vous les démarches administratives, juridiques et la facturation avec cette société.</p>
                                
                                <div style="margin-top: 15px; background: #f8f9fa; padding: 15px; border-left: 4px solid #007bff; border-radius: 4px;">
                                    <h4 style="margin-top:0; font-weight: bold;">Demandez votre simulation personnalisée</h4>
                                    <p>Vous souhaitez connaître le montant de votre futur salaire net et optimiser vos revenus en portage salarial ? Nos conseillers réalisent pour vous une simulation sur-mesure sans aucun engagement.</p>
                                    <a href="{{ url('/contact') }}" class="btn btn-primary" style="background-color: #007bff; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block;">Demander une simulation de salaire</a>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Cadre Juridique et Types de Contrats -->
                        <div class="service-list">
                            <div class="service-list-col1"> <i class="icon-lock"></i> </div>
                            <div class="service-list-col2">
                                <h3>Cadre Juridique & Contrats (CDD / CDI)</h3>
                                <p>Le portage salarial repose sur une relation tripartite claire et sécurisée par le Code du Travail :</p>
                                <ul style="list-style-type:disc">
                                    <li><b>Contrat de travail (CDI ou CDD) :</b> Signé entre HOMSYS et le consultant porté, garantissant la protection sociale d'un salarié (Sécurité sociale, prévoyance, retraite, assurance chômage).</li>
                                    <li><b>Contrat de prestation de service :</b> Conclu entre HOMSYS et votre entreprise cliente pour cadrer la mission, le tarif journalier (TJM) et la durée.</li>
                                    <li><b>Convention d'adhésion :</b> Définit les conditions de gestion et les engagements mutuels.</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Avantages -->
                        <div class="service-list">
                            <div class="service-list-col1"> <i class="icon-comment"></i> </div>
                            <div class="service-list-col2">
                                <h3>Les Avantages du portage salarial</h3>
                                <ul style="list-style-type:disc">
                                    <li>Sécuriser et formaliser votre statut de freelance via un contrat régulier vous permettant ainsi de justifier vos revenus et bénéficier de tous les avantages d'un salarié.</li>
                                    <li>Créer son activité sans créer de structure juridique (pas de bilan comptable, pas d'engagements financiers personnels).</li>
                                    <li>Bénéficier d'une assurance Responsabilité Civile Professionnelle (RC Pro) incluse.</li>
                                    <li>Un conseiller dédié à votre disposition pour vous accompagner au quotidien.</li>
                                    <li>Priorité sur nos offres de missions et accès au réseau d'experts HOMSYS.</li>
                                    <li>Bénéficier du statut salarial complet (Sécurité sociale, prévoyance, retraite et assurance chômage).</li>
                                    <li>Constituer et conserver sa propre clientèle en toute autonomie.</li>
                                    <li>Ne pas risquer son patrimoine personnel.</li>
                                    <li><span style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight: bold">Aucun minimum de chiffre d’affaires :</span> Profitez de notre solution souple et flexible sans aucun minimum imposé.</li>
                                    <li><span style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight: bold">Gestion administrative et comptable :</span> Émission des fiches de paie, versement des cotisations et taxes, HOMSYS assure 100% de la gestion.</li>
                                </ul>
                            </div>
                        </div>

                        <!-- 3. Parcours du consultant & Étapes d'intégration -->
                        <div class="service-list">
                            <div class="service-list-col1"> <i class="icon-database"></i> </div>
                            <div class="service-list-col2">
                                <h3>LE FONCTIONNEMENT & ÉTAPES EN PORTAGE SALARIAL</h3>
                                <p><b>VOTRE PARCOURS SIMPLIFIÉ EN 4 ÉTAPES :</b></p>
                                <ol style="padding-left: 20px;">
                                    <li style="margin-bottom: 8px;"><b>Négociation de la mission :</b> Vous trouvez votre client et définissez librement les modalités (tarifs, durée, livrables).</li>
                                    <li style="margin-bottom: 8px;"><b>Contractualisation :</b> HOMSYS établit le contrat de prestation avec votre client et votre contrat de travail (CDD/CDI).</li>
                                    <li style="margin-bottom: 8px;"><b>Réalisation & Compte Rendu d'Activité (CRA) :</b> Vous effectuez votre mission et validez vos jours travaillés à la fin du mois.</li>
                                    <li style="margin-bottom: 8px;"><b>Facturation & Versement du salaire :</b> HOMSYS facture le client et vous verse votre salaire mensuel avec bulletin de paie.</li>
                                </ol>
                                <img src="{{url('img/portage.png')}}" alt="Schéma du fonctionnement du portage salarial" style="max-width:100%; margin: 15px 0;">
                            </div>
                        </div>

                        <!-- 4. Gestion des Frais Professionnels -->
                        <div class="service-list">
                            <div class="service-list-col1"> <i class="icon-paper-clip"></i> </div>
                            <div class="service-list-col2">
                                <h3>Gestion des Frais Professionnels & Optimisation</h3>
                                <p>En portage salarial avec HOMSYS, vous pouvez optimiser votre rémunération grâce au remboursement de vos frais professionnels exonérés de cotisations sociales et d'impôts :</p>
                                <ul style="list-style-type:disc">
                                    <li><b>Frais de mission (rechargés au client) :</b> Déplacements, hébergement, repas négociés directement avec le client.</li>
                                    <li><b>Frais de fonctionnement (déduits du chiffre d'affaires) :</b> Achats de matériel informatique, abonnements téléphoniques/internet, documentations et fournitures nécessaires à votre activité.</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Éligibilité -->
                        <div class="service-list">
                            <div class="service-list-col1"> <i class="icon-cog"></i> </div>
                            <div class="service-list-col2">
                                <h3>QUI EST ÉLIGIBLE ?</h3>
                                <ul style="list-style-type:disc">
                                    <li><b>Vous êtes indépendant :</b> Vous souhaitez vous consacrer exclusivement à votre cœur de métier sans gestion administrative.</li>
                                    <li><b>Vous êtes cadre ou consultant expert :</b> Vous souhaitez réaliser des missions ponctuelles ou récurrentes.</li>
                                    <li><b>Vous êtes salarié :</b> Vous souhaitez exercer une activité complémentaire en toute légalité.</li>
                                    <li><b>Vous êtes retraité :</b> Vous souhaitez poursuivre une activité pour compléter votre pension.</li>
                                    <li><b>Vous êtes en reconversion ou recherche d’emploi :</b> Vous souhaitez tester un projet d'entreprise en toute sécurité.</li>
                                </ul>
                            </div>
                        </div>

                        <!-- 5. Call to Action (CTA) & Prise de contact -->
                        <div class="work_bottom" style="margin-top: 30px; text-align: center; background: #222; color: #fff; padding: 25px; border-radius: 6px;">
                            <h3 style="color: #fff; margin-bottom: 10px;">Prêt à vous lancer en portage salarial ?</h3>
                            <p style="margin-bottom: 15px;">Contactez nos experts dès aujourd'hui pour obtenir une simulation financière gratuite et un accompagnement personnalisé.</p>
                            <a href="{{ url('/contact') }}" class="contact_btn" style="display: inline-block !important; width: auto !important; height: auto !important; line-height: normal !important; padding: 12px 25px !important; background: #007bff !important; color: #fff !important; text-decoration: none; border-radius: 4px; font-weight: bold; white-space: nowrap;">Demander une simulation / Nous contacter</a>
                        </div>
                    </div>
                    <figure class="col-lg-6 col-sm-6 text-right wow fadeInUp delay-02s"> </figure>
                </div>
            </div>
        </div>
    </div>
</section>

@stop


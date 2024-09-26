@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title')

@section('content')


         <section class="relative table w-full py-32 lg:py-36 bg-[url('../../assets/images/bg/01.jpg')] bg-no-repeat bg-center bg-cover">
            <div class="absolute inset-0 bg-black opacity-80"></div>
            <div class="container relative">
                <div class="grid grid-cols-1 text-center mt-10">
                    <h3 class="md:text-4xl text-3xl md:leading-normal leading-normal font-medium text-white">Politique de confidentialité</h3>
                </div><!--end grid-->
            </div><!--end container-->
        </section><!--end section-->
        <div class="relative">
            <div class="shape overflow-hidden z-1 text-white dark:text-slate-900">
                <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>
        <!-- End Hero -->

        <!-- Start Terms & Conditions -->
       <section class="relative lg:py-24 py-16">
    <div class="container relative">
        <div class="md:flex justify-center">
            <div class="md:w-3/4">
                <div class="p-6 bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-md">
                    <h5 class="text-xl font-medium mb-4">Aperçu :</h5>
                    <p class="text-slate-400">Dernière mise à jour : Jeudi 22 Août 2024</p>
                    <p class="text-slate-400">Bienvenue sur https/www.monauto.ci </p>
                    <p class="text-slate-400">Nous nous engageons à protéger votre vie privée et à garantir la sécurité de vos informations personnelles. Cette Politique de confidentialité explique comment nous collectons, utilisons, partageons et protégeons vos données lorsque vous utilisez monauto.ci</p>
                
                    <h5 class="text-xl font-medium mb-4 mt-8">Collecte des informations :</h5>
                    <p> Nous collectons les informations que vous nous fournissez directement, notamment lorsque vous </p>
                    <ul class="list-unstyled text-slate-400 mt-4">
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Créez un compte sur notre plateforme</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Publiez une annonce pour vendre ou faire louer une voiture</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Effectuez un achat ou une vente</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Contactez notre service client</li>
                    </ul>
                    <ul class="list-unstyled text-slate-400 mt-4">
                        <p> Les types d'informations que nous collectons peuvent inclure </p>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Vos informations personnelles : nom, adresse, numéro de téléphone, adresse e-mail, etc.</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Les informations de votre véhicule : marque, modèle, année, kilométrage, etc</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Les informations de paiement : carte de crédit, coordonnées bancaires, etc.</li>
                    </ul>

                    <h5 class="text-xl font-medium mb-4 mt-8">Utilisation des informations :</h5>
                    <p> Nous utilisons les informations que nous collectons pour : </p>
                    <ul class="list-unstyled text-slate-400 mt-4">
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Vous fournir les services demandés</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Gérer votre compte et faciliter vos transactions</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Améliorer monauto.ci et nos services</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Communiquer avec vous concernant votre compte ou vos transactions</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Vous envoyer des offres promotionnelles et des informations sur nos produits et services, si vous y avez consenti</li>
                    </ul>
                    
                     <h5 class="text-xl font-medium mb-4 mt-8">Partage des informations :</h5>
                    <p> Nous ne partageons vos informations personnelles qu'avec des tiers dans les situations suivantes : </p>
                    <ul class="list-unstyled text-slate-400 mt-4">
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Lorsque cela est nécessaire pour effectuer une transaction (par exemple, avec des services de paiement)</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Avec des prestataires de services qui nous aident à gérer notre activité (hébergement, maintenance de site, etc.)</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Pour se conformer à la loi, à une demande judiciaire ou à d'autres procédures légales</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Pour protéger nos droits, notre propriété ou la sécurité de nos utilisateurs</li>
                    </ul>
                    
                     <h5 class="text-xl font-medium mb-4 mt-8">Sécurité des informations :</h5>
                    <p> Nous mettons en place des mesures de sécurité appropriées pour protéger vos informations contre tout accès non autorisé, altération, divulgation ou destruction. Toutefois, aucune méthode de transmission sur Internet ou de stockage électronique n'est totalement sécurisée, et nous ne pouvons garantir une sécurité absolue </p>
                    
                    
                    <h5 class="text-xl font-medium mb-4 mt-8">Vos droits :</h5>
                    <p> Vous avez le droit de </p>
                    <ul class="list-unstyled text-slate-400 mt-4">
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Accéder à vos informations personnelles</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Demander la rectification de vos informations si elles sont incorrectes ou incomplètes</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Demander la suppression de vos informations personnelles</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Vous opposer au traitement de vos informations pour des motifs légitimes</li>
                        <li class="flex mt-2"><i class="uil uil-arrow-right text-green-600 align-middle me-2"></i>Pour exercer ces droits, veuillez nous contacter à l'adresse servicemarketing@monauto.ci</li>
                    </ul>
                    
                    
                    <h5 class="text-xl font-medium mb-4 mt-8">Cookies :</h5>
                    <p class="text-slate-400">Nous utilisons des cookies et des technologies similaires pour améliorer votre expérience sur monauto.ci, analysant ainsi l'utilisation du site et de personnaliser le contenu. Vous pouvez contrôler l'utilisation des cookies dans les paramètres de votre navigateur</p>

                    <h5 class="text-xl font-medium mb-4 mt-8">Modifications de la politique de confidentialité :</h5>
                    <p class="text-slate-400">Nous nous réservons le droit de modifier cette Politique de confidentialité à tout moment. Toute modification sera publiée sur cette page avec la date de mise à jour. Nous vous encourageons à consulter régulièrement cette page pour rester informé(e) des changements</p>
                    <div class="mt-8">
                        <a href="{{ asset('front/assets/documents/politique_confidentialite.pdf') }}" class="btn bg-green-600 hover:bg-green-700 text-white rounded-md" download>Télécharger</a>
                    </div>
                </div>
            </div><!--end -->
        </div><!--end grid-->

            </div><!--end container-->
        </section><!--end section-->
        <!-- End Terms & Conditions -->

@endsection


@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title')

@section('content')

  <section class="relative table w-full py-32 lg:py-36 bg-[url('../../assets/images/bg/01.jpg')] bg-no-repeat bg-center bg-cover">
            <div class="absolute inset-0 bg-black opacity-80"></div>
            <div class="container relative">
                <div class="grid grid-cols-1 text-center mt-10">
                    <h3 class="md:text-4xl text-3xl md:leading-normal leading-normal font-medium text-white">Conditions d'utilisation</h3>
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
                            <h5 class="text-xl font-medium mb-4">Introduction :</h5>
                            <p class="text-slate-400">Dernière mise à jour : Jeudi 22 Août 2024 Bienvenue sur https/www.monauto.ci En accédant à monauto.ci et en utilisant nos services, vous acceptez les présentes Conditions d'utilisation. Veuillez lire attentivement avant d'utiliser notre site</p>

                            <h5 class="text-xl font-medium mb-4 mt-8">Acceptation des Conditions :</h5>
                            <p class="text-slate-400">En accédant à la plateforme, vous acceptez d'être lié par ces Conditions d'utilisation ainsi que par notre Politique de confidentialité. Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser notre plateforme.</p>
                            <h5 class="text-xl font-medium mb-4 mt-8">Services :</h5>
                            <p class="text-slate-400 mt-3">monauto.ci offre une place de marché en ligne permettant aux utilisateurs de vendre et d'acheter des voitures d'occasion, de faire ou de louer un véhicule. Nous agissons en tant qu'intermédiaire et ne sommes pas responsables de la qualité, de la sécurité ou de la légalité des voitures listées sur www.monauto.ci</p>
                            <h5 class="text-xl font-medium mb-4 mt-8">Compte utilisateur :</h5>
                            <p class="text-slate-400 mt-3">Pour accéder à certaines fonctionnalités de la plateforme, monauto.ci, vous devez créer un compte. Vous êtes responsable de maintenir la confidentialité de vos informations de compte et de votre mot de passe. Vous acceptez de nous notifier immédiatement toute utilisation non autorisée de votre compte. Nous ne sommes pas responsables des pertes résultant de l'utilisation non autorisée de votre compte.</p>
                            <h5 class="text-xl font-medium mb-4 mt-8">Annonces et transactions :</h5>
                            <p class="text-slate-400">Les utilisateurs peuvent publier des annonces pour vendre des voitures d'occasion sur monauto.ci. En publiant une annonce, vous garantissez que les informations fournies sont exactes, complètes et conformes à la réalité. Vous acceptez également de respecter les lois en vigueur lors de la vente de votre véhicule.</p>
                            <p class="text-slate-400">Les transactions réalisées via monauto.ci sont conclues directement entre les acheteurs et les vendeurs. Nous ne garantissons pas le succès des transactions ni la conformité des voitures aux descriptions fournies dans les annonces.</p>
                            <h5 class="text-xl font-medium mb-4 mt-8">Frais et paiements :</h5>
                            <p class="text-slate-400 mt-3">L'utilisation de certaines fonctionnalités de monauto.ci peut être soumise à des frais. Vous acceptez de payer tous les frais applicables en lien avec l'utilisation de ces services. Nous nous réservons le droit de modifier nos offres à tout moment, moyennant un préavis raisonnable.</p>
                            <h5 class="text-xl font-medium mb-4 mt-8">Utilisation acceptable :</h5>
                            <p class="text-slate-400 mt-3">Vous vous engagez à utiliser monauto.ci de manière légale et respectueuse. Il est interdit de :
                                                            - Publier des informations fausses, trompeuses ou diffamatoires ;
                                                            - Envoyer des courriers indésirables (spam) ou des communications non sollicitées ;
                                                            - Harceler ou intimider d'autres utilisateurs ;
                                                            - Usurper l'identité d'une autre personne ou entité ;
                                                            - Publier du contenu illégal, obscène, ou autrement répréhensible.
                                                            
                                                            Nous nous réservons le droit de suspendre ou de résilier votre compte si vous violez ces règles ou si nous estimons que votre utilisation de la plateforme est nuisible.
                                                            </p>

                            <h5 class="text-xl font-medium mb-4 mt-8">Propriété intellectuelle :</h5>
                            <p class="text-slate-400">Tout le contenu de monauto.ci, textes, graphiques, logos, images et logiciels, est notre propriété ou celle de nos concédants de licence et est protégé par les lois sur la propriété intellectuelle en vigueur. Vous ne pouvez pas copier, reproduire ou utiliser le contenu de la plateforme sans notre autorisation expresse.</p>
                            <h5 class="text-xl font-medium mb-4 mt-8">Limitation de responsabilité :</h5>
                            <p class="text-slate-400 mt-3">Nous ne serons en aucun cas responsables des dommages indirects, spéciaux ou consécutifs résultant de votre utilisation de monauto.ci ou de toute transaction réalisée via monauto.ci. Notre responsabilité totale envers vous pour toutes réclamations découlant de votre utilisation de monauto.ci est limitée au montant que vous nous avez payé pour l'utilisation de nos services.</p>
                            <h5 class="text-xl font-medium mb-4 mt-8">Modifications des Conditions d'utilisation :</h5>
                            <p class="text-slate-400 mt-3">Nous nous réservons le droit de modifier ces Conditions d'utilisation à tout moment. Toute modification sera publiée sur cette page avec la date de mise à jour. En continuant à utiliser www.monauto.ci après la publication des modifications, vous acceptez les nouvelles conditions.</p>
                            <h5 class="text-xl font-medium mb-4 mt-8">Résiliation :</h5>
                            <p class="text-slate-400">Nous nous réservons le droit de résilier ou de suspendre votre accès à monauto.ci à tout moment, avec ou sans préavis, pour toute raison, y compris en cas de violation des présentes Conditions d'utilisation.</p>
                            <h5 class="text-xl font-medium mb-4 mt-8">Loi applicable :</h5>
                            <p class="text-slate-400 mt-3">Ces Conditions d'utilisation sont régies par les lois applicables en Côte d’Ivoire. Tout litige relatif à ces Conditions d'utilisation sera soumis à la juridiction exclusive du tribunal de commerce d’Abidjan.</p>
                            
                            
                            

                            <div class="mt-6">
                                <a href="{{ asset('front/assets/documents/condition_utilisation.pdf') }}" class="btn bg-green-600 hover:bg-green-700 text-white rounded-md" download>Accepter</a>
                                <a href="" class="btn bg-transparent hover:bg-green-600 border border-green-600 text-green-600 hover:text-white rounded-md ms-2">Decliner</a>
                            </div>
                        </div>
                    </div><!--end -->
                </div><!--end grid-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- End Terms & Conditions -->

@endsection


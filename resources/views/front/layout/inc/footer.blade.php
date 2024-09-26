<script>
                // Fonction pour appliquer le thème
function applyTheme(theme) {
    document.documentElement.classList.toggle('dark', theme === 'dark');
    // Met à jour le localStorage
    localStorage.setItem('theme', theme);
}

// Fonction pour gérer le changement de thème
function changeTheme(e) {
    e.preventDefault();
    const newTheme = document.documentElement.classList.contains('dark') ? 'light' : 'dark';
    applyTheme(newTheme);
}

// Fonction pour gérer le changement automatique en fonction de l'heure
function updateThemeBasedOnTime() {
    const now = new Date();
    const isDark = now.getHours() >= 18 || now.getHours() < 6;
    applyTheme(isDark ? 'dark' : 'light');
}

// Au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || (new Date().getHours() >= 18 ? 'dark' : 'light');
    applyTheme(savedTheme);

    // Écouteur d'événement pour le changement de thème manuel
    const themeSwitcher = document.getElementById('theme-switcher');
    if (themeSwitcher) {
        themeSwitcher.addEventListener('click', changeTheme);
    }

    // Gérer le changement via la case à cocher
    const chk = document.getElementById('chk');
    if (chk) {
        chk.addEventListener('change', changeTheme);
        // Initialiser la case à cocher selon le thème actuel
        chk.checked = savedTheme === 'dark';
    }

    // Mettre à jour le thème toutes les heures
    setInterval(updateThemeBasedOnTime, 3600000);

    // Enregistrer l'heure actuelle avant de quitter la page
    window.addEventListener('beforeunload', () => {
        localStorage.setItem('lastUpdate', Date.now());
    });
});

</script>

<!-- Start Footer -->
        <footer class="relative bg-slate-900 dark:bg-green-600 mt-24">
            <div class="container relative">
                <div class="grid grid-cols-1">
                    <div class="relative py-16">
                        <!-- Subscribe -->
                        <div class="relative w-full">
                            <div class="relative -top-40 bg-white dark:bg-slate-900 lg:px-8 px-6 py-10 rounded-xl shadow-lg dark:shadow-gray-700 overflow-hidden">
                                <div class="grid md:grid-cols-2 grid-cols-1 items-center gap-[30px]">
                                    <div class="md:text-start text-center z-1">
                                        <h3 class="md:text-3xl text-2xl md:leading-normal leading-normal font-medium text-black dark:text-white"></h3>
                                        {{-- <p class="text-slate-400 max-w-xl mx-auto">Subscribe to get latest updates and information.</p> --}}
                                    </div>

                                    <div class="subcribe-form z-1">
                                        
                                    </div>
                                </div>

                               

                                
                            </div>

                            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px] -mt-24">
                                <div class="lg:col-span-4 md:col-span-12">
                                    <a href="#" class="text-[22px] focus:outline-none">
                                        <img src="/images/site/{{ get_settings()->site_logo }}" width="158" alt="">
                                    </a>
                                    <p class="mt-6 text-gray-300">{{ get_settings()->site_meta_description }}</p>
                            
                                </div><!--end col-->
                        
                                <div class="lg:col-span-2 md:col-span-4">
                                    <h5 class="tracking-[1px] text-gray-100 font-semibold">À Propos</h5>
                                    <ul class="list-none footer-list mt-6">
                                        <li><a href="/" class="text-slate-300 hover:text-slate-400 duration-500 ease-in-out"><i class="uil uil-angle-right-b me-1"></i> Notre Entreprise</a></li>
                                        <li class="mt-[10px]"><a href="/" class="text-slate-300 hover:text-slate-400 duration-500 ease-in-out"><i class="uil uil-angle-right-b me-1"></i> Nos Services</a></li>
                                        <li class="mt-[10px]"><a href="/" class="text-slate-300 hover:text-slate-400 duration-500 ease-in-out"><i class="uil uil-angle-right-b me-1"></i> Tarifs</a></li>
                                    </ul>
                                </div><!--end col-->
                        
                                <div class="lg:col-span-3 md:col-span-4">
                                    <h5 class="tracking-[1px] text-gray-100 font-semibold">Liens Utiles</h5>
                                    <ul class="list-none footer-list mt-6">
                                        <li><a href="{{ route('conditions-generales') }}" class="text-slate-300 hover:text-slate-400 duration-500 ease-in-out"><i class="uil uil-angle-right-b me-1"></i> Conditions Généraless</a></li>
                                        <li class="mt-[10px]"><a href="{{ route('politique-confidentialite') }}" class="text-slate-300 hover:text-slate-400 duration-500 ease-in-out"><i class="uil uil-angle-right-b me-1"></i> Politique de Confidentialité</a></li>
                                        <li class="mt-[10px]"><a href="javascript:;" class="text-slate-300 hover:text-slate-400 duration-500 ease-in-out"><i class="uil uil-angle-right-b me-1"></i> Annonces</a></li>
                                    </ul>
                                </div><!--end col-->
    
                                <div class="lg:col-span-3 md:col-span-4">
                                    <h5 class="tracking-[1px] text-gray-100 font-semibold">Coordonnées</h5>
                            
                            
                                    <div class="flex mt-6">
                                        <i data-feather="map-pin" class="size-5 text-green-600 me-3"></i>
                                        <div class="">
                                           
                                             <a href="http://maps.google.com/maps?q=<?= urlencode(get_settings()->site_address) ?>" target="_blank"><h6 class="text-gray-300 mb-2">{{ get_settings()->site_address }}</h6></a>
                                        </div>
                                    </div>

                                    <div class="flex mt-6">
                                        <i data-feather="mail" class="size-5 text-green-600 me-3"></i>
                                        <div class="">
                                            <a href="mailto:{{ get_settings()->site_email }}" class="text-slate-300 hover:text-slate-400 duration-500 ease-in-out">{{ get_settings()->site_email }}</a>
                                        </div>
                                    </div>
                            
                                    <div class="flex mt-6">
                                        <i data-feather="phone" class="size-5 text-green-600 me-3"></i>
                                        <div class="">
                                            <a href="tel:{{ get_settings()->site_phone }}" class="text-slate-300 hover:text-slate-400 duration-500 ease-in-out">{{ get_settings()->site_phone }}</a>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </div><!--end grid-->
                        </div>
                        <!-- Subscribe -->
                    </div>
                </div>
            </div><!--end container-->

            <div class="py-[30px] px-0 border-t border-gray-800 dark:border-gray-700">
                <div class="container relative text-center">
                    <div class="grid md:grid-cols-2 items-center gap-6">
                        <div class="md:text-start text-center">
                            <p class="mb-0 text-gray-300">© <script>document.write(new Date().getFullYear())</script> Monauto <i class="mdi mdi-check text-red-600"></i> par <a href="" target="_blank" class="text-reset">LearderAutoServices</a>.</p>
                        </div>

                        <ul class="list-none md:text-end text-center">
                            <li class="inline"><a href="/" target="_blank" class="btn btn-icon btn-sm text-gray-400 hover:text-white border border-gray-800 dark:border-gray-700 rounded-md hover:border-green-600 dark:hover:border-green-600 hover:bg-green-600 dark:hover:bg-green-600"><i class="uil uil-behance align-baseline"></i></a></li>
                            <li class="inline"><a href="{{ get_social_network()->linkedin_url }}" target="_blank" class="btn btn-icon btn-sm text-gray-400 hover:text-white border border-gray-800 dark:border-gray-700 rounded-md hover:border-green-600 dark:hover:border-green-600 hover:bg-green-600 dark:hover:bg-green-600 uil uil-linkedin"></a></li>
                            <li class="inline"><a href="{{ get_social_network()->facebook_url }}" target="_blank" class="btn btn-icon btn-sm text-gray-400 hover:text-white border border-gray-800 dark:border-gray-700 rounded-md hover:border-green-600 dark:hover:border-green-600 hover:bg-green-600 dark:hover:bg-green-600 uil uil-facebook"></a></li>
                            <li class="inline"><a href="{{ get_social_network()->instagram_url }}" target="_blank" class="btn btn-icon btn-sm text-gray-400 hover:text-white border border-gray-800 dark:border-gray-700 rounded-md hover:border-green-600 dark:hover:border-green-600 hover:bg-green-600 dark:hover:bg-green-600 uil uil-instagram"></a></li>
                            <li class="inline"><a href="{{ get_social_network()->twitter_url }}" target="_blank" class="btn btn-icon btn-sm text-gray-400 hover:text-white border border-gray-800 dark:border-gray-700 rounded-md hover:border-green-600 dark:hover:border-green-600 hover:bg-green-600 dark:hover:bg-green-600 uil uil-twitter"></a></li>
                            <li class="inline"><a href="mailto:{{ get_settings()->site_email }}" class="btn btn-icon btn-sm text-gray-400 hover:text-white border border-gray-800 dark:border-gray-700 rounded-md hover:border-green-600 dark:hover:border-green-600 hover:bg-green-600 dark:hover:bg-green-600 uil uil-envelope"></a></li>
                        </ul><!--end icon-->
                    </div><!--end grid-->
                </div><!--end container-->
            </div>
        </footer><!--end footer-->
        <!-- End Footer -->
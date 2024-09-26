@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title')

@section('content')


          <section class="relative table w-full py-32 lg:py-36 bg-[url('../front/assets/images/bg/01.png')] bg-no-repeat bg-center bg-cover">
                <div class="absolute inset-0 bg-black opacity-80"></div>
                <div class="container relative">
                    <div class="grid grid-cols-1 text-center mt-10">
                        <h3 class="md:text-4xl text-3xl md:leading-normal leading-normal font-medium text-white">Detail De la location de {{ $location->modele }} {{ $location->category }}</h3>
                    </div><!--end grid-->
                </div><!--end container-->
            </section><!--end section-->

        <section class="relative md:py-24 pt-24 pb-16">
            <div class="container relative">
                <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                    <div class="lg:col-span-8 md:col-span-7">
                        <div class="grid grid-cols-1 relative">
                            <div class="tiny-one-item">
                                @php
                                    $images = json_decode($location->location_images, true);
                                @endphp
                               @foreach ($images as  $image)
                                <div class="tiny-slide">
                                    <img src="/images/locations/{{ $image }}" class="rounded-md shadow dark:shadow-gray-700" alt="">
                                </div>
                                @endforeach

                            </div>
                        </div>
                        
                        <h4 class="text-2xl font-medium mt-6 mb-3">{{ $location->modele }} {{ $location->category }} {{ $location->annee }}</h4>
                        <span class="text-slate-400 flex items-center"><i data-feather="map-pin" class="size-5 me-2"></i> {{ $location->concession->concession_name }}  {{ $location->concession->concession_address }}</span>

                        <br>
                              
                        <p class="text-slate-400">{!! $location->description !!}</p>
                        <p class="text-slate-400 mt-4">{{ $location->concession->concession_description }}</p>
                        
                 {{-- debut affiche equipements --}}

            <div class="features py-6 px-4  rounded-lg shadow-md max-w-3xl mx-auto">
        <!-- Separator Section -->
        <div class="text-center mb-4">
            <span class="block h-1 w-20 bg-blue-600 mx-auto mb-2"></span>
            <span class="block h-1 w-12 bg-gray-800 mx-auto"></span>
        </div>

        <!-- Features Title -->
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-4">Équipements</h2>

        <!-- Features Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @php
                // Convert the description string into an array of features
                $features = explode(', ', $location->equipements);
            @endphp

            @foreach ($features as $feature)
                <div class="feature-card  border border-gray-200 rounded-lg p-3 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="feature-icon mb-2 flex justify-center">
                        <!-- Use a generic icon or customize with specific icons -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#008A22" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none"></rect>
                            <circle cx="128" cy="128" r="96" fill="none" stroke="#008A22" stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></circle>
                        </svg>
                    </div>
                    <div class="feature-info text-center">
                        <h3 class="text-md font-medium text-gray-700">{{ $feature }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- fin affiche equipements --}}
<br>
    
            <div class="features py-6 px-4 rounded-lg shadow-md max-w-3xl mx-auto">
        <!-- Separator Section -->
        <div class="text-center mb-4">
            <span class="block h-1 w-20 bg-blue-600 mx-auto mb-2"></span>
            <span class="block h-1 w-12 bg-gray-800 mx-auto"></span>
        </div>

        <!-- Features Title -->
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-4">Accessoires</h2>

        <!-- Features Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @php
                // Convert the description string into an array of features
                $features = explode(', ', $location->accesoires);
            @endphp

            @foreach ($features as $feature)
                <div class="feature-card border border-gray-200 rounded-lg p-3 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="feature-icon mb-2 flex justify-center">
                        <!-- Use a generic icon or customize with specific icons -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#008A22" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none"></rect>
                            <circle cx="128" cy="128" r="96" fill="none" stroke="#008A22" stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></circle>
                        </svg>
                    </div>
                    <div class="feature-info text-center">
                        <h3 class="text-md font-medium text-gray-700">{{ $feature }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
                        <div class="w-full border-0 mt-4">
                            <img src="/images/Locations/carte_assurance/{{ $location->image_assurance }}" style="border:0" class="w-full h-[300px]" allowfullscreen>
                        </div>
                    </div>

                    <div class="lg:col-span-4 md:col-span-5">
                        <div class="sticky top-20">
                            <div class="rounded-md bg-slate-50 dark:bg-slate-800 shadow dark:shadow-gray-700">
                                <div class="p-6">
                                    <h5 class="text-2xl font-medium">Prix:</h5>
    
                                    <div class="flex justify-between items-center mt-4">
                                        <span class="text-xl font-medium">{{ $location->prix }} FCFA/JOUR</span>
    
                                        <span class="bg-green-600/10 text-green-600 text-sm px-2.5 py-0.75 rounded h-6">EN LOCATION</span>
                                    </div>
    
                                    <ul class="list-none mt-4">
                                        <li class="flex justify-between items-center">
                                            <span class="text-slate-400 text-sm">Date Mise En Circulation</span>
                                            <span class="font-medium text-sm">{{ $location->annee_circulation }}</span>
                                        </li>
    
                                        <li class="flex justify-between items-center mt-2">
                                            <span class="text-slate-400 text-sm">Date Limite Assurance</span>
                                            <span class="font-medium text-sm">{{ $location->date_assurance_fin }}</span>
                                        </li>
    
                                        <li class="flex justify-between items-center mt-4">
                                            <span class="text-slate-400 text-sm">Prix Hors Abidjan</span>
                                            <span class="font-medium text-xl">{{ $location->dernier_prix }} FCFA/JOUR</span>
                                        </li>
                                    </ul>
                                </div>
    
                                <div class="flex">
                                    <div class="p-1 w-1/2">
                                        <a href="{{ $location->whatsapp_link }}" target="_blank" class="btn bg-green-600 hover:bg-green-700 text-white rounded-md w-full">WhatsApp</a>
                                    </div>
                                    <div class="p-1 w-1/2">
                                        <a href="" class="btn bg-green-600 hover:bg-green-700 text-white rounded-md w-full">Payer</a>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-12 text-center">
                                <h3 class="mb-6 text-xl leading-normal font-medium text-black dark:text-white">Vous rencontrez un problème ? Signalez-le-nous</h3>

                                <div class="mt-6">
                                    <a href="https://wa.me/2250758700692" target="_blank" class="btn bg-transparent hover:bg-green-600 border border-green-600 text-green-600 hover:text-white rounded-md"><i class="uil uil-phone align-middle me-2"></i> En cliquant ici</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--end section-->

@endsection


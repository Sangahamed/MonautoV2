@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title')
@section('content')

<!-- Hero Start -->
        <section class="relative mt-20">
            <div class="container-fluid md:mx-4 mx-2">
                <div class="relative pt-40 pb-52 table w-full rounded-2xl shadow-md overflow-hidden" id="home">
                    <div class="absolute inset-0 bg-black/60"></div>

                    <div class="container relative">
                        <div class="grid grid-cols-1">
                            <div class="md:text-start text-center">
                                <h1 class="font-bold text-white lg:leading-normal leading-normal text-4xl lg:text-5xl mb-6">Vendez facilement votre véhicule sur monauto.ci</h1>
                                <p class="text-white/70 text-xl max-w-xl">Achetez, vendez ou louez un véhicule sans intermédiaire…</p>
                            </div>
                        </div><!--end grid-->
                    </div><!--end container-->
                </div>
            </div><!--end Container-->
        </section><!--end section-->
        <!-- Hero End -->

        <!-- Start -->
        <section class="relative md:pb-24 pb-16">
            <div class="container relative">
                <div class="grid grid-cols-1 justify-center">
                    <div class="relative -mt-32">
                        <div class="grid grid-cols-1">
                            <ul class="inline-block sm:w-fit w-full flex-wrap justify-center text-center p-4 bg-white dark:bg-slate-900 rounded-t-xl border-b dark:border-gray-800" id="myTab" data-tabs-toggle="#StarterContent" role="tablist">
                                <li role="presentation" class="inline-block">
                                    <button class="px-6 py-2 text-base font-medium rounded-md w-full hover:text-green-600 transition-all duration-500 ease-in-out" id="buy-home-tab" data-tabs-target="#buy-home" type="button" role="tab" aria-controls="buy-home" aria-selected="true">Acheter</button>
                                </li>
                                
                                <li role="presentation" class="inline-block">
                                    <button class="px-6 py-2 text-base font-medium rounded-md w-full transition-all duration-500 ease-in-out" id="rent-home-tab" data-tabs-target="#rent-home" type="button" role="tab" aria-controls="rent-home" aria-selected="false">Location</button>
                                </li>
                            </ul>

                            <div id="StarterContent" class="p-6 bg-white dark:bg-slate-900 rounded-ss-none rounded-se-none md:rounded-se-xl rounded-xl shadow-md dark:shadow-gray-700">
                                <div class="" id="buy-home" role="tabpanel" aria-labelledby="buy-home-tab">
                                    <form action="{{ route('vente-vehicule') }}">
                                        <div class="registration-form text-dark text-start">
                                            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 lg:gap-0 gap-6">
                                                <div>
                                                    <label class="form-label font-medium text-slate-900 dark:text-white">Recherche : <span class="text-red-600">*</span></label>
                                                    <div class="filter-search-form relative filter-border mt-2">
                                                        <i class="uil uil-search icons"></i>
                                                        <input name="search" type="text" class="form-input filter-input-box bg-gray-50 dark:bg-slate-800 border-0" placeholder="Entrer le modele de vehicule">
                                                    </div>
                                                </div>
                                                

                                                <div>
                                                    <label for="buy-properties" class="form-label font-medium text-slate-900 dark:text-white">Selectionner Marque:</label>
                                                    <div class="filter-search-form relative filter-border mt-2">
                                                        <i class="uil uil-car icons"></i>
                                                        <select class="form-select z-2" data-trigger id="choices-catagory-buy" aria-label="Default select example">
														<option value="">Selectionner la Marque</option>                                                            
                                                            @foreach ($categories as $item)
														<option value="{{ $item->category_name }}">{{ $item->category_name }}</option>
													     @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            
                                                <div>
                                                    <label for="buy-min-price" class="form-label font-medium text-slate-900 dark:text-white">Prix :</label>
                                                    <div class="filter-search-form relative filter-border mt-2">
                                                        <i class="uil uil-usd-circle icons"></i>
                                                        <select class="form-select" data-trigger  id="choices-min-price-buy" aria-label="Default select example">
                                                            <option>Prix</option>
                                                         @foreach ($prices as $price)
                                                            <option value="{{ $price }}">{{ $price }}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="lg:mt-6">
                                                    <input type="submit" id="search-buy" class="btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white searchbtn submit-btn w-full !h-12 rounded">
                                                </div>
                                            </div><!--end grid-->
                                        </div><!--end container-->
                                    </form>
                                </div>

                                

                                <div class="hidden" id="rent-home" role="tabpanel" aria-labelledby="rent-home-tab">
                                    <form action="{{ route('location-vehicule') }}">
                                        <div class="registration-form text-dark ltr:text-start rtl:text-end">
                                            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 lg:gap-0 gap-6">
                                                <div>
                                                    <label class="form-label font-medium text-slate-900 dark:text-white">Recherche : <span class="text-red-600">*</span></label>
                                                    <div class="filter-search-form relative filter-border mt-2">
                                                        <i class="uil uil-search icons"></i>
                                                        <input name="search" type="text" class="form-input filter-input-box bg-gray-50 dark:bg-slate-800 border-0" placeholder="Entrer le modele de vehicule">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="buy-properties" class="form-label font-medium text-slate-900 dark:text-white">Selectionner Marque:</label>
                                                    <div class="filter-search-form relative filter-border mt-2">
                                                        <i class="uil uil-car icons"></i>
                                                        <select class="form-select z-2" data-trigger id="choices-catagory-rent" aria-label="Default select example">
														<option value="">Selectionner la Marque</option>
                                                             @foreach ($categories as $item)
														<option value="{{ $item->subcategory_name }}">{{ $item->category_name }}</option>
													     @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            
                                                <div>
                                                    <label for="buy-min-price" class="form-label font-medium text-slate-900 dark:text-white">Min :</label>
                                                    <div class="filter-search-form relative filter-border mt-2">
                                                        <i class="uil uil-usd-circle icons"></i>
                                                        <select class="form-select" data-trigger id="choices-min-price-rent" aria-label="Default select example"> 
                                                            <option>Prix</option>
                                                         @foreach ($prix as $price)
                                                            <option value="{{ $price }}">{{ $price }}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="lg:mt-6">
                                                    <input type="submit" id="search-rent" class="btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white searchbtn submit-btn w-full !h-12 rounded">
                                                </div>
                                            </div><!--end grid-->
                                        </div><!--end container-->
                                    </form>
                                </div>
                            </div>
                        </div><!--end grid-->
                    </div>
                </div><!--end grid-->
            </div><!--end container-->

            <div class="container relative lg:mt-24 mt-16">
                <div class="grid grid-cols-1 pb-8 text-center">
                    <h3 class="mb-4 md:text-3xl md:leading-normal text-2xl leading-normal font-semibold">Véhicules Disponibles</h3>

                    <p class="text-slate-400 max-w-xl mx-auto">Cherche et trouve ta voiture au meilleur prix du marché.</p>
                </div><!--end grid-->

                <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 mt-8 gap-[30px]">
                    @foreach($vehicles as $item)
                    <div class="group rounded-xl bg-white dark:bg-slate-900 shadow hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-700 dark:hover:shadow-gray-700 overflow-hidden ease-in-out duration-500">
                        <div class="relative">
                            <?php 
                                $venteImages = json_decode($item->imagevehiculevente, true); // Décoder si nécessaire
                                $firstImage = $venteImages[0] ?? null; // Récupérer la première image
                            ?>
                            @if ($firstImage)
                           <a href="{{ route('detail-vehicule', ['idVendre' => $item->idVendre]) }}">
                            <img src="/images/Vendre/{{ $firstImage }}" alt="">
                            </a>
                            @else
                            @endif

                            <div class="absolute top-4 end-4">
                                 @if($item->concession)
                                <a href="javascript:void(0)"><img class="btn btn-icon bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-full text-slate-100 dark:text-slate-700 focus:text-red-600 dark:focus:text-red-600 hover:text-red-600 dark:hover:text-red-600" src="/images/concession/{{ $item->concession->concession_logo }}" alt=""></a>
                                @else
                                <a href="javascript: il void(0)"><img class="btn btn-icon bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-full text-slate-100 dark:text-slate-700 focus:text-red-600 dark:focus:text-red-600 hover:text-red-600 dark:hover:text-red-600" src="/images/users/default-avatar.png" alt=""></a>
                                
                               @endif
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="pb-6">
                                <a href="{{ route('detail-vehicule', ['idVendre' => $item->idVendre]) }}" class="text-lg hover:text-green-600 font-medium ease-in-out duration-500">{{ $item->modele }} {{ $item->category }} {{ $item->annee }}</a>
                            </div>

                            <ul class="py-6 border-y border-slate-100 dark:border-gray-800 flex items-center list-none">
                                <li class="flex items-center me-4">
                                    <i class="mdi mdi-gas-station text-2xl me-2 text-green-600"></i>
                                    <span>{{ $item->carburant }}</span>
                                </li>

                                <li class="flex items-center me-4">
                                    <i class="mdi mdi-speedometer text-2xl me-2 text-green-600"></i>
                                    <span>{{ $item->kilometrage }} Km</span>
                                </li>

                                <li class="flex items-center me-4">
                                    <img src="/images/users/gear-stick.png" width="28" height="28" alt="" class="text-2xl me-2 text-green-600">
                                    <!--<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>-->
                                    <span>{{ $item->transmission }}s</span>
                                </li>
                            </ul>

                            <ul class="pt-6 flex justify-between items-center list-none">
                                <li>
                                    <span class="text-slate-400">Prix</span>
                                    <p class="text-lg font-medium">{{ $item->prix }} FCFA</p>
                                </li>

                            </ul>
                        </div>
                    </div><!--end property content-->
                   @endforeach
                </div><!--en grid-->


            </div><!--end container-->


            <div class="container relative lg:mt-24 mt-16">
                <div class="grid grid-cols-1 pb-8 text-center">
                    <h3 class="mb-4 md:text-3xl md:leading-normal text-2xl leading-normal font-semibold">Comment ça marche</h3>

                    <p class="text-slate-400 max-w-xl mx-auto">Vendre votre véhicule est facile et rapide avec notre plateforme. Suivez ces étapes simples pour commencer.</p>
                </div><!--end grid-->

                <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 mt-8 gap-[30px]">
                    <!-- Content -->
                    <div class="group relative lg:px-10 transition-all duration-500 ease-in-out rounded-xl bg-transparent overflow-hidden text-center">
                        <div class="relative overflow-hidden text-transparent -m-3">
                            <i data-feather="hexagon" class="size-32 fill-green-600/5 mx-auto"></i>
                            <div class="absolute top-2/4 -translate-y-2/4 start-0 end-0 mx-auto text-green-600 rounded-xl transition-all duration-500 ease-in-out text-4xl flex align-middle justify-center items-center">
                                <i class="uil uil-user-check"></i>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h5 class="text-xl font-medium">Créez un compte</h5>
                            <p class="text-slate-400 mt-3">Inscrivez-vous sur notre plateforme pour pouvoir gérer vos annonces et suivre vos ventes ou location.</p>
                        </div>
                    </div>
                    <!-- Content -->

                    <!-- Content -->
                    <div class="group relative lg:px-10 transition-all duration-500 ease-in-out rounded-xl bg-transparent overflow-hidden text-center">
                        <div class="relative overflow-hidden text-transparent -m-3">
                            <i data-feather="hexagon" class="size-32 fill-green-600/5 mx-auto"></i>
                            <div class="absolute top-2/4 -translate-y-2/4 start-0 end-0 mx-auto text-green-600 rounded-xl transition-all duration-500 ease-in-out text-4xl flex align-middle justify-center items-center">
                                <i class="uil uil-upload"></i>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h5 class="text-xl font-medium">Soumettez votre annonce</h5>
                            <p class="text-slate-400 mt-3">Téléchargez les photos et les détails de votre véhicule pour créer une annonce attrayante.</p>
                        </div>
                    </div>
                    <!-- Content -->

                    <!-- Content -->
                    <div class="group relative lg:px-10 transition-all duration-500 ease-in-out rounded-xl bg-transparent overflow-hidden text-center">
                        <div class="relative overflow-hidden text-transparent -m-3">
                            <i data-feather="hexagon" class="size-32 fill-green-600/5 mx-auto"></i>
                            <div class="absolute top-2/4 -translate-y-2/4 start-0 end-0 mx-auto text-green-600 rounded-xl transition-all duration-500 ease-in-out text-4xl flex align-middle justify-center items-center">
                                <i class="uil uil-thumbs-up"></i>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h5 class="text-xl font-medium">Recevez des offres</h5>
                            <p class="text-slate-400 mt-3">Recevez des propositions d'acheteurs intéressés et négociez les meilleures offres.</p>
                        </div>
                    </div>
                    <!-- Content -->

                    <!-- Content -->
                    <div class="group relative lg:px-10 transition-all duration-500 ease-in-out rounded-xl bg-transparent overflow-hidden text-center">
                        <div class="relative overflow-hidden text-transparent -m-3">
                            <i data-feather="hexagon" class="size-32 fill-green-600/5 mx-auto"></i>
                            <div class="absolute top-2/4 -translate-y-2/4 start-0 end-0 mx-auto text-green-600 rounded-xl transition-all duration-500 ease-in-out text-4xl flex align-middle justify-center items-center">
                                <i class="uil uil-wallet"></i>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h5 class="text-xl font-medium">Finalisez la vente</h5>
                            <p class="text-slate-400 mt-3">Concluez la vente ou la location, transférez la propriété du véhicule, et profitez du paiement.</p>
                        </div>
                    </div>
                    <!-- Content -->
                </div><!--end grid-->
            </div>
          <!--end container-->

           
            <div class="container relative lg:mt-24 mt-16">
                <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                    <div class="lg:col-span-4 md:col-span-5">
                        <div class="sticky top-20">
                            <ul class="flex-column text-center p-6 bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-md" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                                <li role="presentation">
                                    <button class="px-4 py-2 text-base font-medium rounded-md w-full transition-all duration-500 ease-in-out text-white bg-green-600" id="trust-tab" data-tabs-target="#trust" type="button" role="tab" aria-controls="trust" aria-selected="true">Pourquoi nous faire confiance ?</button>
                                </li>
                                <li role="presentation">
                                    <button class="px-4 py-2 text-base font-medium rounded-md w-full mt-3 transition-all duration-500 ease-in-out hover:text-green-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800" id="transparency-tab" data-tabs-target="#transparency" type="button" role="tab" aria-controls="transparency" aria-selected="false">Collaboration ouverte</button>
                                </li>
                                <li role="presentation">
                                    <button class="px-4 py-2 text-base font-medium rounded-md w-full mt-3 transition-all duration-500 ease-in-out hover:text-green-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800" id="security-tab" data-tabs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">Sécurité et fiabilité</button>
                                </li>
                                <li role="presentation">
                                    <button class="px-4 py-2 text-base font-medium rounded-md w-full mt-3 transition-all duration-500 ease-in-out hover:text-green-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800" id="customer-service-tab" data-tabs-target="#customer-service" type="button" role="tab" aria-controls="customer-service" aria-selected="false">Service client exceptionnel</button>
                                </li>
                                <li role="presentation">
                                    <button class="px-4 py-2 text-base font-medium rounded-md w-full mt-3 transition-all duration-500 ease-in-out hover:text-green-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800" id="easy-process-tab" data-tabs-target="#easy-process" type="button" role="tab" aria-controls="easy-process" aria-selected="false">Processus simplifié</button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="lg:col-span-8 md:col-span-7">
                        <div id="myTabContent">
                            <div class="" id="trust" role="tabpanel" aria-labelledby="trust-tab">
                                <img src="data:image/png;base64,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" alt="Pourquoi nous faire confiance ?">
                                <div class="mt-6">
                                    <h5 class="font-medium text-xl">Pourquoi nous faire confiance ?</h5>
                                    <p class="text-slate-400 mt-3">Nous nous engageons à offrir une expérience transparente et sécurisée. Découvrez pourquoi nous sommes le meilleur choix pour vendre ou louer votre véhicule.</p>
                                    <p class="text-slate-400 mt-3">Nous garantissons une transparence totale dans toutes nos transactions. Vous savez exactement ce que vous payez et ce que vous recevez.</p>
                                    <p class="text-slate-400 mt-3">Nous inspectons tous les véhicules déposés sur la plateforme par nos experts</p>
                                    <p class="text-slate-400 mt-3">Nous sommes disponibles H24 pour vous satisfaire</p>
                                </div>
                            </div>
                            <div class="hidden" id="transparency" role="tabpanel" aria-labelledby="transparency-tab">
                                <img src="data:image/png;base64,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" alt="Transparence totale">
                                <div class="mt-6">
                                    <h5 class="font-medium text-xl">Collaboration ouverte</h5>
                                       <p class="text-slate-400">Nous vous invitons à un **partenariat ouvert** pour vous accompagner dans la vente ou la location de votre véhicule. Ensemble, nous construisons une relation de confiance basée sur la transparence et l'échange.</p>
                                        <ul class="list-disc mt-6 ml-4">
                                        <li>Communication claire et régulière</li>
                                        <li>Conseils personnalisés</li>
                                        <li>Accompagnement sur mesure</li>
                                        <li>Disponibilité et réactivité</li>
                                        </ul>
                                </div>
                            </div>
                            <div class="hidden" id="security" role="tabpanel" aria-labelledby="security-tab">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADgCAMAAADCMfHtAAAAwFBMVEX///8AAABWsyA1NTXa2trk5ORKrwDz8/NErQDExMRTshr7+/u+vr64uLje3t4tLS2RkZHr6+t0dHTv7++xsbFQsRLS0tKoqKh/f3+IiIhbW1tgYGAeHh5nZ2fKysqenp5BQUHC4bSNjY1OTk4TExPk8t0iIiJ6enqUzHpvb2/4/PbP58RJSUk/Pz91v1Fqu0Da7dJ/w16MyXC33Kak049uvEae0Idgty/v9+t4wFW73qut15rV68yKx3GYzoDi8dydHbpeAAAO+0lEQVR4nN1daUPiPBAuCqUUWEEoIp6s97Heiq7r7v//V28LFJrJTDpp0sP3+ahpm4ckcydxnAJQHxbxlRKxU6udNMruRI5o79Ui9MruR26on9YW2D8suyv54Ki2xkGz7N7YR/OkJmCn7A7ZRrcGsfW/mqrNPYlg7X8lVeUBXGLcLrtrVtA/oQj+T5bjkYJftBw7ZXfQEIf7aoIhNr+zyBmgEkbC7ajsjmbFTxa/CJMfuu8+u3m+vJttuJ7rz16fXqYP13kwUGPI5hfhoM9/87/nxw3PdQPf34jg+0EQMn19uSmUZWdLi2DEkTeOZy9+OG4LbgL8kObjTc60Vmht6vKLMKmnvnh67wUyuRUCN3h5L4Bfh+a39UvJ8UQtc37PXGTwAEnvb94ch+eKmZiqH49pjlM/nd+SY44Lsq0kMLdgBhMlRcpYPbvzOPQWHINpTvzqF6q+n8eipKVoRJk4Lx5r/Jbw3dc8pupQvca21y3bu1SjC/zV73euBr8FR9tidaQcvhAtoXkDn6rn+MtveAtQhHdpkV6jl6b99qSwRQuzWHEx88xfgUm4d7boHaUrP3R1yUIJn6Mv2QiGAufegkzl0KtdEY5uE85stN1f3SWYoDgzkzeDzsUpykjElkKLNwTnA3WH37ITDOXNRuZRbLZ2mYbnkfpFo+P1T4H9/zPrFF1SnGUg167vXLHN6qv0wGgrtoFayD+nZgTDiaonbvqHOxc6PsNxuikdoTsXq5vIf85MCYYSlaU0mo3RsHdwnEYIYAsbFBzDU1zezjLoQQhvbcENu53W4WhUr//4UR+NDludzk5vvD3J5AiFyrvL5hdh5xfyxyeVp4QjCOH7gv/orgSqwifQxr4ePxzaizDwZk9fX1+Pd3ezxG+zXoraXjmJTRv8nGvdEXSfEurvbK1lVvPU1hjeWgoPfmkydN8SD58lTVl/qRXTQ5scXNkKDerKUfcp8fC7YKvH3DkGSgr2j+wlBh/1hjB4TTx7DYSw926H4ZXN6PU/zSEMkvbZB/h1gsUgmtGbdO0mkjSH0HtIPHsp2bLutSHDva7ttPW73hB6vxPPIv6k+2nA8HzMt134+NRyKdyvxKN/kB/H38jK8GqYUyJXy14L7hNPXqO/zXwWa5LbvMiLnaMpZ3xByryiCzj4q8VwMh6O8q0XedORM96/xJNUSMDlMNw6nuwedetFJN91JqmXDP+Stmw0TQGf7cGP0MEIPYxO6HLUG81mgWUF7xpyxv3LejCSpkDj7xZHSMKUz1B04l/JsffvKsXwkr8MBSmj0jFhQ8CwzBJCeiggBFvmQSWBQ3m0Xx2G7EnqviQf21D9MO4N9A9TwoB5AjXZAjcEoBB8JB9Th1bd5wox/CN3NXAvpzfTzw+RpJtchMo5Otf5m5VhKIvS4HHJ5Xp6v84kCpowTYf6j85xZRg+Q4Z+0vD8c7/8d5D06p2XlMUbqouTyjCUhD5Idy5D/YKiSA963DuTyjB8geow+BIbPAThjPQE2ul23sw5qC7DjWD2T2jx7vt6czSCs10Zhp+ySeN7z0KTd1GOcrytmQPylSVqfNT48t6ENu86cnSOe2dcGYa/0SnnPpIPcOZoKEtBsWSJljfhWpAUWcHjUB+CyoFxoaQEPFB+OkGRZagHb9G2qySI4p0iQIYS3S+sOT6ppWef4aaBbexlBYHssvcpN8aDazLDG6cjMrwqntgK9LTz5Jo8Zo7KO4MFdQe59J0X7PlLd9qFJTIpLsUKoY03Ehnu2aXWbO0eLHzsX9tHaRUMijiNYIRHuOfFA/zQlWyIDE9s8uvCjTMXyqpuVawNFFfwxMwi1tYU+4CVDmQEkNILKHdZqGwUweJmiplFQAcw3LfFr4PxizAZkM/ItvcaiyzLEooVKyIIG7dBB+zwa6v2zZA7u5VWSiIGzE6FL3KkIFBjhWBfXR1AKl2lKb1OVHxww46LqCMI1Ngg+EPJL5qpxIPK/KEf5+yxVCH+xKKCD8g7jX06TIL7k+3xFQgHESJbnQOO9T5TU8xNtgjABdbebSVhkHzdQScWLGLZLWFZKCu+lsKGn94IFi/tiQzNC2MSVVZjMd+YKCslHFG1DHHng6iMcQvNl6Fx4D4Z146sgwbnshGT0JH4T6kexGhdcZX9OnIMnAvTQzrWdi46EX+sM0GosapeidEgstM3buyRAMPUNBS10hOEShisGuDhBGUaIjRPpbgx2XZlIgDD9KcZwdWcJ52UtRGFlzyoU0lT7ggmzDxg1Bg6iPFr0AL1BepxGzxicqOcpwF3kiYTVCJDM+ditUlWVZKykt54ZYdcvZUBQi2KWEOLlZbzccua67GhSKx5tkZXQHBFRCP51IRgP36LulnsdxCumo1afSFLDKLeJkVBsbpLE1cpc1m9FDkExQAk8FRNiroOmO+IVyKlfH+bURTqah1J5ZsYNctXEBsK14htc9KNMtoWJO1eq4sMDSru42WYGjiPNRStUzJvzsO25w1Ehga5mfi3Srf8YhOcbpF5orof8stEhgZR73i+p0/0q3SxNtXa5byC94S8S/Tyb7MzjPV9ugcWZ7xU/vbZTH97kI8lANY/aOrMSUMsldO96B6r5ZP2BqGNf+iLelVl6EwDnWH0PTRJ5UihzexxDOsMnetL/mp07x+o1wB1kf0MJ/sMHefhlcfRdZ/plwD/KbsPnAdDx/nzoTy7ZT4/3Q0FPwfu7squLmKG6YafDsNwHL+k+kSBnveaduaHWBd1zPqqhEGjH/f7sJGCflwB0mo06DRGEtPH6AAlmV7gurPP9P33QJhmKV4fZt8htsXbGX395+XViw6Kmu+H9YMgJOf5l1PW8QLA9s4Q9kYzaWzw3Zmzm8+Xr8e7+9fHp7fP6QP78AQQhtff0QQTWJqwnHhO76C+ME1NxaQgB04AomWqX61QJ3peHYZjww9WnyE4KY8nwBOoPkPQQ+1ARvUZmoqa6jMEFfva0vsbMBRFjXZU+BswNLRqvgFDkGLTjSgqGfYaUX3btqpJLpwAxC/qVgorGB7EdrzK7rHNBoO47SI1aA1AM0z8Vk36GBWrVAgA50BT55MMhWxkg2pVCEMwhzRjNSRD0S8ij4a0SISG+EnNhUgxBAlCchAN+l0fcg9XEfOkijQ8+hmi59A4oo5s0vua02/UR63uTu9iMo8wMTOeYCHqaUSKIZzst0Q7rY/B+cYt+gULUa9wqFiGoKvsZJn4mJ4XTDGEH6f0hdbHYJ0auxJv2+CjTElDKn2tj8GZwH4OZC+0ahRJbSFGfMdUM51vwcp0/mwDqWCtTWwkw+NkK9pu0/mWQamheKizVtE+bbUldor1yUZ6DMG+Xg3zCyxgnaoTleUda6tDuo0eQ/FRnRqurELYUXtPsTutaKLFEMgLrYiLmHrQ+XFUDOMu9BRtdHoJcvJa+VxgGGtMUxXDVSW7HYYgaKbn52WvFlYwXG+tUJwjqtFJMEk1C37FhzWkqYLh2nBTXKCg0UdwBgQvM7fCOOvTCobrRla0RTPzk3OAacp3EllRDHiMSqZ+AhdIuyo964dphklRR6dR+T0Eu7S0K2OANGWnSkmGgsqBMywDQ6CzNR11uafsqnaSoXhoPnnbHLuDoJ45Q2EM2DfItflIhmKAgbwwkNs9mE3XTgNKEp1ruZH+4WErCWOGYCVn2TkBJDo3RVNU3gIYDZnKmU8yvaMghtA9yUIQLpXjSjEE9kzGk2bAt3l2TTEMoe2ecd8EOJGHFwUphiFQFVl3aEHrkfVDFcIQGgyZ62DBWQGsWsxCGAKDK/sGLWB+s7RqEQzhEBpsdgVKh+NhqPx3BlieKEzNGRxwDC0PTmrH7B4Qjg8Eh9DoyK4M7zIaxGNOp2C83OjsBxgV46zE5s/bzWw4YS0oKOLNTnuCFnyZ53/FAIFu08Mt4KK2cBqIIaCwpg5H4WJg+X3mgKlV49M74AV+ZV8TDo9kMj+vC65r3Qoi24BbHTSjpBjgIKKXFBYGKNxt1PbDlWi0h90UUijZyh0iUJyWeZ4iDNHZ6YsU27R1KZc+pAvpM0TYMMC5b+2oOl1Iv7W1g4Dhiw0PrskM6ZZka2+Wgpvmp4BlgTRHrdxBuAC8cFs/SWAB0hw12EwvQXLcyzgnWqqEszqTruDbi5enUt7Y7lnVcjbM6usZgDEjo9gFBmmV578VUoC8cTP7TnoCUNgUbJ9K+Ub7bpwcfilSZciF7zlYx9JHTou7pUw+p9f0xEMUUpjQpj5SQq7VzEcKyN8p6G4BZHt4TtNHrmQqRtrIF4PncS3oHJI8tS+yEchlG/nNHaRYy0KYJAWSOZWrVYxUUOR3FekCSMl7rp9ENkfmG7ZBim1zURRryBtBzvOkiJRp5n11CpJZ2spP8yMFfmZHjnKAXAOQG0Ws0LaAWCayN3IzH4pYwXshfilSVpjLWvwpfydvKbNEGzkl6dRS4DIBbGdUUcETNI9tW0nBPGiE4rxuOaJge4W0sQ2YhfkyDlH/ajF6OcAKOorN66H7eqytEnSO2MpRcIHukLQUO8EL+QuvIICJ0zn2bcgbTMbkb+EjkL2aCMaLsY/XVJWSKcF/a0PDmKhwLycVBIszl9gymU/4xCiLIDWK2aM3uAwtZQ3GICieZDNTqfNOSiRIzqoswzgiLvfK1cNmgPrdjzV/+DZ1eFROnpkGyH12uzpdk1JbMcqvo1Ps0eI7cw3qoJMyb+xNgJKAtdovlr/RRM2jOUq8GlxAnz65ay/VmmwrNufnFrzXRpvcLyndtwahOnW4VC0BQR7dFWKX5qg6NnpSuhAVQd41quA4VF1vWeLN7gT6cg4sgSvJsmwrTh2olV+KjEJ54GNtIoiNPnnG0By3JdsxFFrKXtdOj+I4xEgqwRNRFSUho6mQqauBbO6k7BvaKs1X4iD1yPlT1e3Ac5RV2slFP20YU1DtAVyANKI5qJ6OwNBMnYgUbitlxahwmO2Gi2ISS5agOuuKwLhiVloa+ppT9eQbSBiIOunWytiqpJGWjkPuluBvtQBFdGnfeI3voSFIdFUeUoSfFTWyNdBVzVWFd/yd0KLOLjv6ZgpCgRGiOza/sXzBMAA2wF55W/zyQ2etIHe/jQGqiX4vMlhvLRZtVBCHvRKH7z9xHvj4JroMIwAAAABJRU5ErkJggg==" alt="Sécurité et fiabilité">
                                <div class="mt-6">
                                    <h5 class="font-medium text-xl">Sécurité et fiabilité</h5>
                                    <p class="text-slate-400 mt-3">Notre plateforme utilise les dernières technologies pour garantir la sécurité de vos informations et la fiabilité de vos transactions.</p>
                                </div>
                            </div>
                            <div class="hidden" id="customer-service" role="tabpanel" aria-labelledby="customer-service-tab">
                                <img src="data:image/png;base64,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" alt="Service client exceptionnel">
                                <div class="mt-6">
                                    <h5 class="font-medium text-xl">Service client exceptionnel</h5>
                                    <p class="text-slate-400 mt-3">Notre équipe de support est disponible pour répondre à toutes vos questions et vous aider tout au long du processus de vente ou de location.</p>
                                </div>
                            </div>
                            <div class="hidden" id="easy-process" role="tabpanel" aria-labelledby="easy-process-tab">
                                <img src="data:image/jpeg;base64,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" alt="Processus simplifié">
                                <div class="mt-6">
                                    <h5 class="font-medium text-xl">Processus simplifié</h5>
                                    <p class="text-slate-400 mt-3">Nous avons simplifié le processus de vente et de location pour que vous puissiez gérer tout depuis un seul endroit, rapidement et facilement.</p>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div><!--end grid-->
            </div>
<!--end container-->

            <div class="container relative lg:mt-24 mt-16">
                <div class="grid grid-cols-1 text-center">
                    <h3 class="mb-6 md:text-3xl md:leading-normal text-2xl leading-normal font-semibold">Vous rencontrez un problème ? </h3>

                    <p class="text-slate-400 max-w-xl mx-auto">Signalez-le-nous !</p>
                
                    <div class="mt-6">
                        <a href="https://wa.me/2250758700692" target="_blank" class="btn bg-green-600 hover:bg-green-700 text-white rounded-md"><i class="uil uil-phone align-middle me-2"></i> En cliquant ici</a>
                    </div>
                </div><!--end grid-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- End -->


@endsection
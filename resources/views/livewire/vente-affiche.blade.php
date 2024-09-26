<div>
       <div class="container relative -mt-[25px]">
                <div class="grid grid-cols-1">
                    <div class="subcribe-form z-1">
                        <form  action="javascript:;" method="get" class="relative max-w-2xl mx-auto">
                            <i data-feather="search" class="size-5 absolute top-[47%] -translate-y-1/2 start-4"></i>
                            <input type="text" id="search-input" wire:model.live="search" class="rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 ps-12" value="{{ $search }}" placeholder="Marque,Type,modele,Prix :">
                            
                        </form><!--end form-->
                    </div>
                </div>
        </div>
          <!-- Start -->
    <section class="relative lg:py-24 py-16">
            <div class="container relative">

        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 mt-8 gap-[30px]">
                     @forelse ($vendres as $item)
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
                                <a href="javascript:void(0)"><img class="btn btn-icon bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-full text-slate-100 dark:text-slate-700 focus:text-red-600 dark:focus:text-red-600 hover:text-red-600 dark:hover:text-red-600" src="/images/users/default-avatar.png" alt=""></a>
                                
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

                                <li class="flex items-center">
                                    <i class="mdi mdi-speedometer text-2xl me-2 text-green-600"></i>
                                    <span>{{ $item->kilometrage }} Km</span>
                                </li>

                                <li class="flex items-center me-4">
                                     <img src="/images/users/gear-stick.png" width="28" height="28" alt="" class="text-2xl me-2 text-green-600">
                                    <span>{{ $item->transmission }}</span>
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

         
    @empty
        <p>Pas de vehicule trouver.</p>
           @endforelse
                </div><!--en grid-->
                 <div class="md:flex justify-center text-center mt-6">
                    <div class="md:w-full">
                        {{ $vendres->links() }}
                    </div>
                </div>
                </div><!--end container-->
        
          </section>  

        </div>  
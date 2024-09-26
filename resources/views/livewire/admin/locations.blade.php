<div>
    
    <div class="product-wrap">
        <div class="product-list">

            <ul class="row">
                @forelse ($locations as $item)
                    
                
                <li class="col-lg-4 col-md-6 col-sm-12">
                    <div class="product-box">
                        <div class="producct-img">
                           <?php 
                                $locationImages = json_decode($item->location_images, true); // Décoder si nécessaire
                                $firstImage = $locationImages[0] ?? null; // Récupérer la première image
                            ?>
                            @if ($firstImage)
                            <img src="/images/locations/{{ $firstImage }}" alt="">
                            @else
                            @endif
                        </div>
                        <div class="product-caption">
                            <h4><a href="#">{{ $item->modele }}</a></h4>
                            <h4><a href="#">{{ $item->subcategory }}</a></h4>
                            <div class="price">
                                @if ( $item->dernier_prix )
                                    Hors Abidjan <span>{{$item->dernier_prix }} Francs CFA</span>
                                @endif
                                
                                <ins>{{ $item->prix }} Francs CFA</ins>
                            </div>
                            <div class="btn-group">
                                @if($item->visibility == 1)
                                    <button wire:click="toggleVisibility({{ $item->id }})" class="btn btn-outline-primary btn-sm">Bloquer</button>
                                @else
                                    <button wire:click="toggleVisibility({{ $item->id }})" class="btn btn-outline-secondary btn-sm">Débloquer</button>
                                @endif

                                <a href="javascript:;" data-id="{{ $item->id }}" id="deleteLocationBtn" class="btn btn-outline-danger btn-sm">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </li>
                @empty
                    <li class="col-12">
                       <span class="text-danger">Vous avez pas de vehicule en location</span>
                    </li>
                @endforelse
            </ul>

        </div>
        <div class="blog-pagination mb-30">
            <div class="btn-toolbar justify-content-center mb-15">
                <div class="btn-group">
                   {{ $locations->links('livewire::simple-bootstrap') }}
                </div>
            </div>
        </div>
    </div>

</div>

<div class="container px-0">
	@if ( Route::is('admin.*') )
						<div class="row">
							

             @forelse ($abonnement_plans as $item)
							<div class="col-md-4 mb-30">
								<div class="card-box pricing-card mt-30 mb-30">
									<div class="pricing-icon">
										<img src="vendors/images/icon-Cash.png" alt="" />
									</div>
									<div class="price-title">{{ $item->name }}</div>
									<div class="pricing-price"><sup></sup>{{ $item->prix }}<sub>/mois</sub></div>
									<div class="cta">
										<a href="{{ route('admin.manage-abonnement.edit-abonnement',['id'=>$item->id]) }}" class="btn btn-primary btn-rounded btn-lg"
											>Modifier</a
										>
									</div>
								</div>
							</div>
							   @empty
                    <li class="col-12">
                       <span class="text-danger">Vous avez pas de vehicule en location</span>
                    </li>
                @endforelse
						</div>
                       @else
					   @endif
						<h4 class="mb-30 mt-30 text-blue h4">Modele Abonnement</h4>
						<div class="row">
                        @forelse ($abonnement_plans as $item)
                            
							<div class="col-md-4 mb-30">
								<div class="card-box pricing-card-style2">
									<div class="pricing-card-header">
										<div class="left">
											<h5>{{ $item->name }}</h5>
											<p>For small businesses</p>
										</div>
										<div class="right">
											<div class="pricing-price">{{ $item->prix }}<span>/mois</span></div>
										</div>
									</div>
									<div class="pricing-card-body">
										<div class="pricing-points">
											<ul>
												<li>{!! $item->description !!}</li>
											</ul>
										</div>
									</div>
									@if ( Route::is('admin.*') )
									<div class="cta">
										<a href="javascript:;" data-id="{{ $item->id }}" id="deleteAbonnementBtn" class="btn btn-danger btn-rounded btn-lg"
											>Supprimer</a
										>
									</div>
									@else
									<div class="cta">
										<a href="javascript:;" data-id="{{ $item->id }}" class="btn btn-danger btn-rounded btn-lg subscribe-btn">s'abonner</a>
									</div>
			                       @endif
								</div>
							</div>
								   @empty
                    <li class="col-12">
                       <span class="text-danger">Pas d'abonnement disponible</span>
                    </li>
                @endforelse
						</div>
                     
					</div>
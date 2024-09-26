@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')

            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Modifier Vente</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('user.home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Modifier
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a href="{{ route('user.vendre.all-vendres') }}" class="btn btn-primary">Voir Tous Mes Vehicules</a>
                    </div>
                </div>
            </div>

					<div class="pd-20 card-box mb-30">
						<div class="clearfix">
							<h4 class="text-blue h4">Information & Image vehicule</h4>
							<p class="mb-30">Veuillez entrez des information valide</p>
						</div>
						<div class="wizard-content">
                             <form class="tab-wizard wizard-circle wizard vertical"  id="steps-uid-1" action="{{ route('user.vendre.update-vendre') }}" method="POST" enctype="multipart/form-data">
								@csrf
								 @if (Session::get('success'))
                                        <div class="alert alert-success">
                                            <strong><i class="dw dw-checked"></i></strong>
                                            {!! Session::get('success') !!}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if (Session::get('fail'))
                                    <div class="alert alert-danger">
                                        <strong><i class="dw dw-checked"></i></strong>
                                        {!! Session::get('fail') !!}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <input type="hidden" name="id" value="{{ $vendre->id }}">
								<h5>Type de Vehicule</h5>
								<section>
									<div class="row">

                                        <div class="col-md-6">
											<div class="form-group">
												<label>Marque de Vehicule:</label>
												<select name="category" id="category" class="custom-select form-control">
													  <option value="" selected>Veuillez Selectionner</option>
													@foreach ($categories as $item)
														<option value="{{ $item->category_name }}" {{ $vendre->category == $item->category_name ? 'selected' : '' }}>{{ $item->category_name }}</option>
													@endforeach
												</select>
											</div>
											@error('category')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>

                                        <div class="col-md-6">
											<div class="form-group">
												<label>Type :</label>
												<input type="text" name="subcategory" value="{{ $vendre->subcategory }}" class="form-control">
												{{-- <select name="subcategory" id="subcategory" class="custom-select form-control">
													<option value="" selected>Veuillez Selectionner</option>
													@foreach ($subcategories as $item)
														<option value="{{ $item->id }}" {{ $vendre->subcategory == $item->subcategory_name ? 'selected' : '' }}>{{ $item->subcategory_name }}</option>
													@endforeach
												</select> --}}
											</div>
											@error('subcategory')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Modele :</label>
												<input name="modele" type="text" class="form-control" value="{{ $vendre->modele }}" />
											</div>
											@error('modele')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Annee :</label>
												<input name="annee" type="text" class="form-control" value="{{ $vendre->annee }}" />
											</div>
											@error('annee')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Kilometrage</label>
												<input name="kilometrage" type="text" class="form-control" value="{{ $vendre->kilometrage }}" />
											</div>
											@error('kilometrage')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Immatriculation :</label>
												<input name="immatriculation" type="text" class="form-control" value="{{ $vendre->immatriculation }}" />
											</div>
											@error('immatriculation')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
									</div>
									
								</section>
								<!-- Step 2 -->
                               <h5>Detail & Prix</h5>
								<section>
									<div class="row">
                                       
										<div class="col-md-6">
											<div class="form-group">
												<label>Type de Transmission</label>
												<select name="transmission"  class="custom-select form-control">
													  <option value="" selected>Veuillez Selectionner</option>
														<option value="Automatique" {{ $vendre->transmission == 'Automatique' ? 'selected' : '' }}>Automatique</option>
													
														<option value="Manuelle"  {{ $vendre->transmission == 'Manuelle' ? 'selected' : '' }}>Manuelle</option>
													
												</select>
											</div>
											@error('transmission')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Type de Carburant</label>
												<select name="carburant"  class="custom-select form-control">
													  <option value="" selected>Veuillez Selectionner</option>
														<option value="Essence" {{ $vendre->carburant == 'Essence' ? 'selected' : '' }}>Essence</option>
                                                        <option value="Diesel" {{ $vendre->carburant == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                                        <option value="Électrique" {{ $vendre->carburant == 'Électrique' ? 'selected' : '' }}>Électrique</option>
                                                        <option value="Hybride" {{ $vendre->carburant == 'Hybride' ? 'selected' : '' }}>Hybride</option>
													
												</select>
											</div>
											@error('carburant')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>

                                        <div class="col-md-6">
											<div class="form-group">
												<label>Couleur Interrieur</label>
												<input name="couleurint" type="text" class="form-control" value="{{ $vendre->couleurint }}" />
											</div>
											@error('couleurint')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>

                                        <div class="col-md-6">
											<div class="form-group">
												<label>Couleur Exterieur</label>
												<input name="couleurext" type="text" class="form-control" value="{{ $vendre->couleurext }}" />
											</div>
											@error('couleurext')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Prix</label>
												
                                                    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><input id="demo5" type="text" class="form-control" name="prix" value="{{ $vendre->prix }}"><span class="input-group-addon bootstrap-touchspin-postfix input-group-append"><span class="input-group-text">Francs CFA</span></span><span class="input-group-btn input-group-append"></span></div>
                                                
											</div>
											@error('prix')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Etat Vehicule</label>
												<select name="etatvehicule"  class="custom-select form-control">
													  <option value="" selected>Veuillez Selectionner</option>
														<option value="Neuf" {{ $vendre->etatvehicule == 'Neuf' ? 'selected' : '' }}>Neuf</option>
                                                        <option value="Occasion" {{ $vendre->etatvehicule == 'Occasion' ? 'selected' : '' }}>Occasion</option>
                                                        <option value="Neuf /Concessionaire" {{ $vendre->etatvehicule == 'Neuf /Concessionaire' ? 'selected' : '' }}>Neuf /Concessionaire</option>
                                                        <option value="Neuf /Importe" {{ $vendre->etatvehicule == 'Neuf /Importe' ? 'selected' : '' }}>Neuf /Importe</option>
                                                        <option value="Occasion /Importe" {{ $vendre->etatvehicule == 'Occasion /Importe' ? 'selected' : '' }}>Occasion /Importe</option>
                                                        <option value="Neuf /Parfait etat" {{ $vendre->etatvehicule == 'Neuf /Parfait etat' ? 'selected' : '' }}>Neuf /Parfait etat</option>
                                                        <option value="Neuf /Bon etat" {{ $vendre->etatvehicule == 'Neuf /Bon etat' ? 'selected' : '' }}>Neuf /Bon etat</option>
                                                        <option value="Neuf /Passable" {{ $vendre->etatvehicule == 'Neuf /Passable' ? 'selected' : '' }}>Neuf /Passable</option>
                                                        <option value="Occasion /Parfait etat" {{ $vendre->etatvehicule == 'Occasion /Parfait etat' ? 'selected' : '' }}>Occasion /Parfait etat</option>
                                                        <option value="Occasion /Bon etat" {{ $vendre->etatvehicule == 'Occasion /Bon etat' ? 'selected' : '' }}>Occasion /Bon etat</option>
                                                        <option value="Occasion /Assez Bon" {{ $vendre->etatvehicule == 'Occasion /Assez Bon' ? 'selected' : '' }}>Occasion /Assez Bon</option>
                                                        
                                                                                                      													
												</select>
											</div>
											@error('etatvehicule')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
									</div>
									
								</section>

								<!-- Step 3 -->
								<h5>equipements & Accessoires</h5>
								<section>
									<label class="weight-600"><h2>equipements</h2></label>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
                                                <input name="equipements[]" value="ABS" type="checkbox" id="equipements1" {{ in_array('ABS', array_map('trim', explode(',', $vendre->equipements))) ? 'checked' : '' }}>
                                                <label for="equipements1">ABS</label>
                                                </div>
												
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
                                                <input name="equipements[]" value="Radio" type="checkbox" id="equipements2" {{ in_array('Radio', array_map('trim', explode(',', $vendre->equipements))) ? 'checked' : '' }}>
                                                <label for="equipements2">Radio</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
                                                <input name="equipements[]" value="Air Bag" type="checkbox" id="equipements3" {{ in_array('Air Bag', array_map('trim', explode(',', $vendre->equipements))) ? 'checked' : '' }}>
                                                <label for="equipements3">Air Bag</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
                                                <input name="equipements[]" value="Camera arriere" type="checkbox" id="equipements4" {{ in_array('Camera arriere', array_map('trim', explode(',', $vendre->equipements))) ? 'checked' : '' }}>
                                                <label for="equipements4">Camera de recul</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
													
                                                <input name="equipements[]" value="Climatisation" type="checkbox" id="equipements5" {{ in_array('Climatisation', array_map('trim', explode(',', $vendre->equipements))) ? 'checked' : '' }}>
                                                <label for="equipements5">Climatisation</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
                                                <input name="equipements[]" value="Direction Assistee" type="checkbox" id="equipements6" {{ in_array('Direction Assistee', array_map('trim', explode(',', $vendre->equipements))) ? 'checked' : '' }}>
                                                <label for="equipements6">Direction Assistee</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
                                                <input name="equipements[]" value="Decapotable" type="checkbox" id="equipements7" {{ in_array('Decapotable', array_map('trim', explode(',', $vendre->equipements))) ? 'checked' : '' }}>
                                                <label for="equipements7">Decapotable</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
                                                <input name="equipements[]" value="Toit Ouvrant" type="checkbox" id="equipements8" {{ in_array('Toit Ouvrant', array_map('trim', explode(',', $vendre->equipements))) ? 'checked' : '' }}>
                                                <label for="equipements8">Toit Ouvrant</label>
                                                </div>
                                            </div>
											@error('equipements')
												<span class="text-danger">{{ $message }}</span>
											   @enderror
                                        </div>
                                        <hr>
                                            <label class="weight-600"><h2>Accessoire</h2></label>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
                                                <input name="accesoires[]" value="Android Auto" type="checkbox" id="accessoire1" {{ in_array('Android Auto', array_map('trim', explode(',', $vendre->accesoires))) ? 'checked' : '' }}>
                                                <label for="accessoire1">Android Auto</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3"> 
                                                <div class="checkbox-container">
                                                <input name="accesoires[]" value="Apple Play" type="checkbox" id="accessoire2" {{ in_array('Apple Play', array_map('trim', explode(',', $vendre->accesoires))) ? 'checked' : '' }}>
                                                <label for="accessoire2">Apple Play</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
                                                <input name="accesoires[]" value="Feux antibrouillard" type="checkbox" id="accessoire3" {{ in_array('Feux antibrouillard', array_map('trim', explode(',', $vendre->accesoires))) ? 'checked' : '' }}>
                                                <label for="accessoire3">Feux antibrouillard</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
                                                <input name="accesoires[]" value="Chargeur USB" type="checkbox" id="accessoire4" {{ in_array('Chargeur USB', array_map('trim', explode(',', $vendre->accesoires))) ? 'checked' : '' }}>
                                                <label for="accessoire4">Chargeur USB</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
                                                <input name="accesoires[]" value="GPS" type="checkbox" id="accessoire5" {{ in_array('GPS', array_map('trim', explode(',', $vendre->accesoires))) ? 'checked' : '' }}">
                                                <label for="accessoire5">GPS</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
                                                <input name="accesoires[]" value="Coffre de Toit" type="checkbox" id="accessoire6" {{ in_array('Coffre de Toit', array_map('trim', explode(',', $vendre->accesoires))) ? 'checked' : '' }}>
                                                <label for="accessoire6">Coffre de Toit</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
                                                <input name="accesoires[]" value="Bluetooth" type="checkbox" id="accessoire7" {{ in_array('Bluetooth', array_map('trim', explode(',', $vendre->accesoires))) ? 'checked' : '' }}>
                                                <label for="accessoire7">Bluetooth</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="checkbox-container">
                                                <input name="accesoires[]" value="Vitre electrique" type="checkbox" id="accessoire8" {{ in_array('Vitre electrique', array_map('trim', explode(',', $vendre->accesoires))) ? 'checked' : '' }}>
                                                <label for="accessoire8">Vitre electrique</label>
                                                </div>
                                            </div>
											@error('accesoires')
												<span class="text-danger">{{ $message }}</span>
											   @enderror
                                        </div>


										<div class="col-md-12">
											<div class="form-group">
												<label><H2>Description</H2></label>
												<textarea  id="description" name="description" class="form-control summernote" cols="30" rows="10">{!! $vendre->description !!}</textarea>
											</div>
											@error('description')
												<span class="text-danger">{{ $message }}</span>
											   @enderror
										</div>

								</section>
								<!-- Step 4 -->
								<h5>Images</h5>
								<section>
									<div class="row">
										<div class="col-md-6">
											<label for=""><b>Certificat de visite technique :</b></label>
											<input type="file" name="image_viste" class="form-control">
											<div class="mb-2 mt-1" style="max-width: 200px">
										      <img src="{{ $vendre->image_viste != null ? '/images/Vendre/image_viste/'.$vendre->image_viste : '' }}" alt="" class="img-thumbnail" id="concession_logo_preview">
										    </div>
											@error('image_viste')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									    </div>
										<div class="col-md-12">
                                             <section class="card-box min-height-200px pd-20 mb-20">
													<div class="title mb-2">
													<h6>Images du Vehicule</h6>
												</div>
													
                                                    <div class="file-upload">
                                                        <input type="file" name="imagevehiculevente[]" class="file-upload-input with-preview" multiple title="Click to add files" maxlength="10" accept="gif|jpg|png|jpeg">
                                                        <span><i class="fa fa-plus-circle"></i>Cliquer pour ajouter des Images</span>
                                                    </div>
                                                    <div class="file-upload-previews">
														<?php 
															$ventesImages = json_decode($vendre->imagevehiculevente, true); // Décoder si nécessaire
															
														?>
														<div class="MultiFile-label">
															<a class="MultiFile-remove" href="#MultiFile1">x</a>
															<span>
															<?php foreach ($ventesImages as $key => $images) : ?>
															<span class="MultiFile-label" title="File selected: {{ $images }}">
															<span class="MultiFile-title">{{ $images }}</span>
															<img class="MultiFile-preview" style="max-height:100px; max-width:100px;" src="/images/Vendre/{{ $images }}"></span>,
															<?php endforeach; ?>
															</span>
														</div>
													</div>
                                                    
                                                    
												</section>

											<div hidden class="form-group">
												<label for=""><b>Visibilty:</b></label>
												<select name="visibility" id="" class="form-control">
													<option value="1" selected>pubique</option>
													<option value="0">privee</option>
												</select>
											</div>
									</div>
								</section>
								<div
							class="modal fade"
							id="success-modal"
							tabindex="-1"
							role="dialog"
							aria-labelledby="exampleModalCenterTitle"
							aria-hidden="true"
						    >
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body text-center font-18">
										<h3 class="mb-20">Soumettez vous!</h3>
										<div class="mb-30 text-center">
											<img src="/back/vendors/images/success.png" />
										</div>
										Veuillez cliquer pour valider tous les information entrez
									</div>
									<div class="modal-footer justify-content-center">
										 <button type="submit" class="btn btn-primary">Confirmer</button>
									</div>
								</div>
							</div>
					</div>
							</form>
						</div>
					</div>

					
					
		@endsection
		@push('scripts')
        <style>
            .box-container{
                width: 100%;
                display: flex;
                flex-direction: row;
                gap: 1rem;
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .box-container .box{
                background: #423838;
                display: block;
                width: 110px;
                height: 110px;
                position: relative;
                overflow: hidden;
            }
            .box-container .box img{
                width: 100%;
                height: auto;
            }

            .box-container .box a{
                position: absolute;
                right: 7px;
                bottom: 5px;
            }

            .swal2-popup{
                font-size: .87em;
            }
        </style>
	
    <script>

        //List sub categories according to the selected category
       $(document).on('change', 'select#category', function(e) {
        e.preventDefault();
        var category_name = $(this).val(); // Récupère le nom de la catégorie sélectionnée
        var url = "{{ route('user.vendre.get-vendre-category') }}";

        if (category_name == '') {
            $("select#subcategory").find("option").not(":first").remove();
        } else {
            $.get(url, { category_name: category_name }, function(response) {
                $("select#subcategory").find("option").not(":first").remove();
                $("select#subcategory").append(response.data);
            }, 'JSON');
        }
     });


    </script>


@endpush

@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')

 <div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="title">
									<h4>model-abonnement</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="/">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											model-abonnement
										</li>
									</ol>
                                    <div class="clearfix">
                   
                    <div class="pull-right">
                        <a href="{{ route('admin.manage-abonnement.add-abonnement') }}" class="btn btn-primary btn-sm" type="button">
                            <i class="fa fa-plus"></i>
                            Ajouter Type
                        </a>
                    </div>
                </div>
								</nav>
							</div>
						</div>
					</div>

					@livewire('admin.model-abonnement')
					
				</div>
			</div>

@endsection

@push('scripts')

<script>
        $(document).on('click','a#deleteAbonnementBtn', function(e){
             e.preventDefault();
             var url = "{{ route('admin.manage-abonnement.delete-abonnement') }}";
             var token = "{{ csrf_token() }}";
             var abonnement_id = $(this).data('id');
             swal.fire({
                title:'Êtes-vous sûr?',
                html:'Vous souhaitez supprimer cette vente et toutes ses images associées',
                showCloseButton:true,
                showCancelButton:true,
                cancelButtonText:'Annuler',
                confirmButtonText:'Oui, Supprimer',
                cancelButtonColor:'#d33',
                confirmButtonColor:'#3085d6',
                width:300,
                allowOutsideClick:false
             }).then(function(result){
                if( result.value ){
                    $.post(url,{ _token:token, id:abonnement_id }, function(response){
                         toastr.remove();
                         if( response.status == 1 ){
                            Livewire.dispatch('refreshmodeleabonnement');
                            toastr.success(response.msg);
                         }else{
                            toastr.error(response.msg);
                         }
                    },'json');
                }
             });
        });
    </script>
@endpush
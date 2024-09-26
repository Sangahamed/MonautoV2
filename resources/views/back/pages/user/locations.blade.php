@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Mes Vehicule En location</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Locations
                    </li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <a href="{{ route('user.location.add-location') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Ajouter Vehicule</a>
        </div>
    </div>
</div>

@livewire('user.locations')

@endsection
@push('stylesheets')
    <style>
        .swal2-popup{
            font-size: .87em;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).on('click','a#deleteProductBtn', function(e){
             e.preventDefault();
             var url = "{{ route('user.location.delete-location') }}";
             var token = "{{ csrf_token() }}";
             var location_id = $(this).data('id');
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
                    $.post(url,{ _token:token, id:location_id }, function(response){
                         toastr.remove();
                         if( response.status == 1 ){
                            Livewire.dispatch('refreshlocationList');
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
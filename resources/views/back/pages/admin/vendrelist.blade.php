@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Les Vehicule En Ventes</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Ventes
                    </li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
        </div>
    </div>
</div>

@livewire('admin.ventes')

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
        $(document).on('click', 'a#deleteVendreBtn', function(e) {
            e.preventDefault();
            var url = "{{ route('admin.delete-vendre') }}";
            var token = "{{ csrf_token() }}";
            var vendre_id = $(this).data("id");
            swal.fire({
                title: 'Êtes-vous sûr?',
                html: 'Vous souhaitez supprimer cette vente et toutes ses images associées',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: 'Annuler',
                confirmButtonText: 'Oui, Supprimer',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                width: 300,
                allowOutsideClick: false,
            }).then(function(result){
                if( result.value ){
                    $.post(url,{ _token:token, id:vendre_id }, function(response){
                         toastr.remove();
                         if( response.status == 1 ){
                            Livewire.dispatch('refreshVentesList');
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
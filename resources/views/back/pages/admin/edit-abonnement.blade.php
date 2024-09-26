@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-dark">Modifier Type</h4>
                </div>
                <div class="pull-right">
                    <a href="{{ route('admin.manage-abonnement.plan-abonnement') }}" class="btn btn-primary btn-sm">
                     <i class="ion-arrow-left-a"></i> Retour list
                    </a>
                </div>
            </div>
            <hr>
            <form action="{{ route('admin.manage-abonnement.update-abonnement') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                <input type="hidden" name="id" value="{{ $abonnementplan->id }}">
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
             <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="">Nom du Modele</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter type" value="{{ $abonnementplan->name }}">
                        @error('name')
                            <span class="text-danger ml-2">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Prix</label>
                        <input type="text" class="form-control" name="prix" placeholder="Enter le type" value="{{ $abonnementplan->prix }}">
                        @error('prix')
                            <span class="text-danger ml-2">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                     <div class="form-group">
                        <label for="">Description</label>
                        <textarea  id="description" name="description" class="form-control summernote" cols="30" rows="10">{!! $abonnementplan->description !!}</textarea>
                        @error('description')
							<span class="text-danger">{{ $message }}</span>
						@enderror
                    </div>
                </div>
                
             </div>
             <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>
    </div>
  </div>
@endsection
@push('scripts')
    
@endpush
@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Concessionnaire Reglages</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Concessionnaire Reglages
                    </li>
                </ol>
            </nav>
        </div>
      
    </div>
</div>

<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <x-alert.form-alert/>
    <form action="{{ route('user.concession-setup') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for=""><b>Concessionnaire Nom:</b></label>
                <input type="text" class="form-control" name="concession_name" placeholder="Enter le nom de la concession..." value="{{ old('concession_name') ? old('concession_name') : $concessionInfo->concession_name }}">
                @error('concession_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for=""><b>Numero:</b></label>
                <input type="text" class="form-control" name="concession_phone" placeholder="ex: +1 234 567 890 (whatsapp)" value="{{ old('concession_phone') ? old('concession_phone') : $concessionInfo->concession_phone }}">
                @error('concession_phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for=""><b>Concession addresse:</b></label>
                <input type="text" class="form-control" name="concession_address" placeholder="ex: 8977 HUXS Street 56" value="{{ old('concession_address') ? old('concession_address') : $concessionInfo->concession_address }}">
                @error('concession_address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label for=""><b>Concession information:</b></label>
                <textarea class="form-control" name="concession_description" cols="30" rows="10" placeholder="description concession...">{{ old('concession_description') ? old('concession_description') : $concessionInfo->concession_description }}</textarea>
                @error('concession_description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for=""><b>Concession logo:</b></label>
                <input type="file" name="concession_logo" class="form-control">
                <div class="mb-2 mt-1" style="max-width: 200px">
                    <img src="{{ $concessionInfo->concession_logo != null ? '/images/concession/'.$concessionInfo->concession_logo : '' }}" alt="" class="img-thumbnail" id="concession_logo_preview">
                </div>
                @error('concession_logo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>

@endsection
@push('scripts')
    <script>
        $('input[type="file"][name="concession_logo"]').ijaboViewer({
            preview:'img#concession_logo_preview',
            imageShape:'square',
            allowedExtensions:['png','jpg','svg'],
            onErrorShape:function(message,element){
                alert(message);
            },
            onInvalidType:function(message, element){
                alert(message);
            },
            onSuccess:function(message, element){}
        });
    </script>
@endpush
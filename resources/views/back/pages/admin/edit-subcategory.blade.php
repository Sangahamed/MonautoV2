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
                    <a href="{{ route('admin.manage-categories.cats-subcats-list') }}" class="btn btn-primary btn-sm">
                     <i class="ion-arrow-left-a"></i> Retour list
                    </a>
                </div>
            </div>
            <hr>
            <form action="{{ route('admin.manage-categories.update-subcategory') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                <input type="hidden" name="subcategory_id" value="{{ request()->id }}">
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
                        <label for="">Marque</label>
                        <select name="parent_category" id="" class="form-control">
                           
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ $subcategory->category_id == $item->id ? 'selected' : '' }}>{{ $item->category_name }}</option>
                            @endforeach
                        </select>
                        @error('parent_category')
                            <span class="text-danger ml-2">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="">Type</label>
                        <input type="text" class="form-control" name="subcategory_name" placeholder="Entrer type de vehicule" value="{{ $subcategory->subcategory_name }}">
                        @error('subcategory_name')
                            <span class="text-danger ml-2">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="">Marque supplementaire</label>
                        <select name="is_child_of" id="" class="form-control">
                            <option value="0">-- Independent --</option>
                            @foreach ($subcategories as $item)
                            @if($item->id != $subcategory->id)
                                <option value="{{ $item->id }}" {{ $subcategory->is_child_of != 0 && $subcategory->is_child_of == $item->id ? 'selected' : '' }}>{{ $item->subcategory_name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('is_child_of')
                            <span class="text-danger ml-2">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                 
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="">marque image</label>
                        <input type="file" name="subcategory_image" id="" class="form-control">
                        @error('subcategory_image')
                            <span class="text-danger ml-2">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="avatar mb-3">
                        <img src="" alt="" data-ijabo-default-img="/images/categories/{{ $subcategory->subcategory_image }}" width="50" height="50" id="subcategory_image_preview">
                    </div>
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
<script>
        $('input[type="file"][name="subcategory_image"]').ijaboViewer({
            preview:'#subcategory_image_preview',
            imageShape:'square',
            allowedExtensions:['png','jpg','jpeg','svg'],
            onErrorShape:function(message,element){
                alert(message);
            },
            onInvalidType:function(message,element){
                alert(message);
            },
            onSuccess:function(message,element){}
        });
    </script>
@endpush
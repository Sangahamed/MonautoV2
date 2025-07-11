<div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="h4 text-blue">Marque Vehicule</h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.manage-categories.add-category') }}" class="btn btn-primary btn-sm" type="button">
                            <i class="fa fa-plus"></i>
                            Ajouter Marque
                        </a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-borderless table-striped">
                        <thead class="bg-secondary text-white">
                            <tr>
                                {{-- <th>Category image</th> --}}
                                <th>Marque Vehicule</th>
                                <th>N. de Type Associer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0" id="sortable_categories">
                            @forelse ($categories as $item)
                            <tr data-index="{{ $item->id }}" data-ordering="{{ $item->ordering }}">
                                
                                <td>
                                    {{ $item->category_name }}
                                </td>
                                <td>
                                    {{ $item->subcategories->count() }}
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.manage-categories.edit-category',['id'=>$item->id]) }}" class="text-primary">
                                            <i class="dw dw-edit2"></i>
                                        </a>
                                        <a href="javascript:;" class="text-danger deleteCategoryBtn" data-id="{{ $item->id }}">
                                            <i class="dw dw-delete-3"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <span class="text-danger">Pas de Marque de vehicule!</span>
                                    </td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
                <div class="d-block mt-2">
                    {{ $categories->links('livewire::simple-bootstrap') }}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="h4 text-blue">Type Vehicule</h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.manage-categories.add-subcategory') }}" class="btn btn-primary btn-sm" type="button">
                            <i class="fa fa-plus"></i>
                            Ajouter Type
                        </a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-borderless table-striped">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <!--<th>Marque image</th>-->
                                <th>Type</th>
                                <th>Marque </th>
                                <th>marque supp</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0" id="sortable_subcategories">

                            @forelse ($subcategories as $item)
                                
                           
                            <tr data-index="{{ $item->id }}" data-ordering="{{ $item->ordering }}">

                                <!--<td>-->
                                <!--    <div class="avatar mr-2">-->
                                <!--        <img src="/images/categories/{{ $item->subcategory_image }}" width="50" height="50" alt="">-->
                                <!--    </div>-->
                                <!--</td>-->
                               
                                <td>
                                   {{ $item->subcategory_name }}
                                </td>
                                <td>
                                    {{ $item->parentcategory->category_name }}
                                </td>
                                <td>
                                    @if ( $item->children->count() > 0 )
                                        <ul class="list-group" id="sortable_child_subcategories">
                                            @foreach ($item->children as $child)
                                                <li data-index="{{ $child->id }}" data-ordering="{{ $child->ordering }}" class="d-flex justify-content-between align-items-center">
                                                    - {{ $child->subcategory_name }}
                                                    <div>
                                                        <a href="{{ route('admin.manage-categories.edit-subcategory',['id'=>$child->id]) }}" class="text-primary" data-toggle="tooltip" title="Edit child sub category">Modifier</a>
                                                        |
                                                        <a href="javascript:;" class="text-danger deleteChildSubCategoryBtn" data-toggle="tooltip" title="Delete child sub category" data-id="{{ $child->id }}" data-title="Child Sub Category">Supprimer</a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        None
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.manage-categories.edit-subcategory',['id'=>$item->id]) }}" class="text-primary">
                                            <i class="dw dw-edit2"></i>
                                        </a>
                                        <a href="javascript:;" class="text-danger deleteSubCategoryBtn" data-id="{{ $item->id }}" data-title="Sub Category">
                                            <i class="dw dw-delete-3"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            @empty
                                <tr>
                                    <td colspan="4">
                                        <span class="text-danger">Pas de Marque!</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-block mt-2">
                    {{ $subcategories->links('livewire::simple-bootstrap') }}
                </div>
            </div>
        </div>
      </div>

</div>

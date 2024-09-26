<div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="h4 text-blue">Utilisateur Normal</h4>
                    </div>
                    <div class="pull-right">
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-borderless table-striped">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Photo Utilisateur</th>
                                <th>Nom</th>
                                <th>email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0" id="sortable_categories">
                            @forelse ($users as $item)
                            <tr data-index="{{ $item->id }}">
                                
                                 <td>
                                    <div class="avatar mr-2">
                                        <img src="{{ $item->picture }}" width="50" height="50" alt="">
                                    </div>
                                </td>
                               
                                <td>
                                   {{ $item->name }}
                                </td>
                                
                                <td>
                                   {{ $item->email }}
                                </td>
                                <td>
                                    <div class="table-actions">
                                           @if($item->status == 1)
                                            <a href="javascript:;" wire:click="toggleStatus({{ $item->id }})" class="text-primary"><i class="dw dw-unlock1"></i></a>
                                        @else
                                            <a href="javascript:;" wire:click="toggleStatus({{ $item->id }})" class="text-primary"><i class="dw dw-user-13"></i></a>
                                        @endif
                                        <a href="javascript:;" class="text-danger deleteCategoryBtn" data-id="{{ $item->id }}">
                                            <i class="dw dw-delete-3"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <span class="text-danger">Il y a pas d'utilisateur!</span>
                                    </td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
                <div class="d-block mt-2">
                    {{ $users->links('livewire::simple-bootstrap') }}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="h4 text-blue">Client</h4>
                    </div>
                    <div class="pull-right">
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-borderless table-striped">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Photo Utilisateur</th>
                                <th>Nom</th>
                                <th>email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                            @forelse ($users as $item)
                                
                           
                            <tr data-index="{{ $item->id }}" data-ordering="{{ $item->ordering }}">

                                <td>
                                    <div class="avatar mr-2">
                                        <img src="{{ $item->picture }}" width="50" height="50" alt="">
                                    </div>
                                </td>
                               
                                <td>
                                   {{ $item->name }}
                                </td>
                                
                                <td>
                                   {{ $item->email }}
                                </td>
                                <td>
                                    <div class="table-actions">

                                         @if($item->status == 1)
                                            <a href="javascript:;" wire:click="toggleStatus({{ $item->id }})" class="text-primary"><i class="dw dw-unlock1"></i></a>
                                        @else
                                            <a href="javascript:;" wire:click="toggleStatus({{ $item->id }})" class="text-primary"><i class="dw dw-user-13"></i></a>
                                        @endif
                                       
                                        <a href="javascript:;" class="text-danger" id="deleteUserBtn" data-id="{{ $item->id }}">
                                            <i class="dw dw-delete-3"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            @empty
                                <tr>
                                    <td colspan="4">
                                        <span class="text-danger">pas de client!</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-block mt-2">
                    {{ $users->links('livewire::simple-bootstrap') }}
                </div>
            </div>
        </div>
      </div>

</div>

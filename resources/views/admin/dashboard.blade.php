@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')
<div class="row">
    <div class="col-md-12" style="margin-top: 100px;">
        <label for="isBlockedFilter">Filter by Blocked Status:</label>
        <select id="isBlockedFilter" class="form-control">
            <option value="">All</option>
            <option value="true">Blocked</option>
            <option value="false">Not Blocked</option>
        </select>

        <div class="card">
    <div class="card-header">
        <h4 class="card-title">Users List</h4>
    </div>
    <div class="card-body" style="overflow-y: auto; max-height: 300px;"> 
        <div class="table-responsive">
            <table class="table table-striped" id="barbersTable">
                <thead>
                    <tr>
                        <th>Verification Status</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userProfiles as $userprofile)
                        <tr>
                            <td>{{ $userprofile['emailVerification'] ? 'True' : 'False' }}</td>
                            <td>{{ $userprofile['age'] ?? 'null' }}</td>
                            <td>{{ $userprofile['gender'] ?? 'null' }}</td>
                            <td>{{ $userprofile['email'] ?? 'null' }}</td>
                            <td>{{ $userprofile['userType'] ?? 'null' }}</td>
                            <td>{{ $userprofile['userStatus'] ?? 'null' }}</td>
                            <td>{{ $userprofile['streetAddress'] ?? 'null' }}</td> <td>
                                    <div class="d-flex justify-content-end">
                                        
                                
                                    <form action="{{ route('user.show', ['id' => $userprofile['_id']]) }}" method="GET">
                                    <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="More Info">
                                        <img src="{{ asset('images/edit.png') }}" alt="" width="16" height="16">
                                    </button>
                                </form>

                                         <form action="{{ route('user.edit', ['id' => $userprofile['_id']]) }}" method="GET">
                                                <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Edit Category">
                                                    <img src="{{ asset('images/edit2.png') }}" alt="" width="16" height="16">
                                                </button>
                                            </form>

                                            <form action="{{ route('user.block', ['id' => $userprofile['_id']]) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Deactivate">
                                                    <img src="{{ asset('images/ban-solid.png') }}" alt="Block" width="16" height="16">
                                                </button>
                                            </form>

                                            
                                    </div>
                                </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    </div>

   



<div class="col-md-12 mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Stores List</h4>
        </div>
        <div class="card-body">
        <div class="card-body" style="overflow-y: auto; max-height: 300px;"> 
            <div class="table-responsive">
            <table class="table table-striped">
                    <thead>
                    <tr style="margin-right:10px";>
                            <th>ID</th>
                            <th>Store Name</th>
                            <th>Store Slogan</th>
                            <th>Description</th>
                            <th>SubCategory</th>
                            <th>Store Status</th>
                            <th>User</th>
                            <th style="margin-left: 30px !important;">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                            @foreach($userVedioProfiles as $userVedioProfile)
                                <tr>
                                    <td>{{ $userVedioProfile['_id'] ?? 'null' }}</td>
                                    <td>{{ $userVedioProfile['storeName']?? 'null' }}</td>
                                    <td>{{ $userVedioProfile['storeSlogan'] ?? 'null'}}</td>
                                    <td>{{ $userVedioProfile['storeDescription'] ?? 'null'}}</td>
                                    <td>{{ $userVedioProfile['subCategory']?? 'null' }}</td>
                                    <td>{{ $userVedioProfile['storeStatus'] ?? 'null'}}</td>
                                    <td>
                                            @foreach($userVedioProfile['userDetails'] as $userDetail)
                                                <option value="{{ $userDetail['_id'] }}"> {{ $userDetail['name'] }}  </option>
                                            @endforeach
                                    </td>
                                    <td>
                                    <div class="d-flex justify-content-end">
                                        
                                    
                                 
                                    <form action="{{ route('store.show', ['id' => $userVedioProfile['_id']]) }}" method="GET">
                                    <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="More Info">
                                        <img src="{{ asset('images/edit.png') }}" alt="" width="16" height="16">
                                    </button>
                                </form>
                                


                                         <form action="{{ route('store.block', ['id' => $userVedioProfile['_id']]) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Deactivate">
                                                    <img src="{{ asset('images/ban-solid.png') }}" alt="Block" width="16" height="16">
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('store.edit', ['id' => $userVedioProfile['_id']]) }}" method="get">
                                                <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Edit Category">
                                                    <img src="{{ asset('images/edit2.png') }}" alt="" width="16" height="16">
                                                </button>
                                            </form>

                                            <form action="{{ route('store.delete', ['id' => $userVedioProfile['_id']]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Delete">
                                                <img src="{{ asset('images/trash-solid.png') }}" alt="Delete" width="16" height="16">
                                            </button>
                                </form>
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                        </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Products List</h4>
        </div>
        <div class="card-body">
        <div class="card-body" style="overflow-y: auto; max-height: 300px;"> 
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Store Id</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>SubCategory</th>
                            <th style="margin-left: 30px !important;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($getproducts as $getproduct)
                                <tr>
                                    <td>{{ $getproduct['_id'] ?? 'null' }}</td>
                                    <td>{{ $getproduct['storeId']?? 'null' }}</td>
                                    <td>{{ $getproduct['productDescription'] ?? 'null'}}</td>
                                    <td>{{ $getproduct['price'] ?? 'null'}}</td>
                                    <td>{{ $getproduct['productsubCategory']?? 'null' }}</td>
                                    
                                    <td>
                                    <div class="d-flex justify-content-end">
                                        
                                 

                                
                                <form action="{{ route('product.edit', ['id' => $getproduct['_id']]) }}" method="get">
                                    <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Edit Product">
                                        <img src="{{ asset('images/edit2.png') }}" alt="" width="16" height="16">
                                    </button>
                                </form>

                                  
                                      <form action="{{ route('product.delete', ['id' => $getproduct['_id']]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Delete">
                                                <img src="{{ asset('images/trash-solid.png') }}" alt="Delete" width="16" height="16">
                                            </button>
                                </form>
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                        </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>


<div class="col-md-12 mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Vedios List</h4>
        </div>
        <div class="card-body">
        <div class="card-body" style="overflow-y: auto; max-height: 300px;"> 
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th> Id</th>

                            <th>User Id</th>
                            <th>videoUrl </th>
                            <th>Description</th>
                            
                            <th style="margin-left: 30px !important;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($getvedios as $getvedio)
                                <tr>
                                <td>{{ $getvedio['_id'] ?? 'null' }}</td>                                    
                                    <td>{{ $getvedio['userId'] ?? 'null' }}</td>
                                    <td>{{ $getvedio['videoUrl']?? 'null' }}</td>
                                    <td>{{ $getvedio['videoDescription'] ?? 'null'}}</td>
                                  
                                    <td>
                                    <div class="d-flex justify-content-end">
                                        
                                    

                                    <form action="{{ route('vedio.delete', ['id' => $getvedio['_id']]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this client?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Delete">
                                            <img src="{{ asset('images/trash-solid.png') }}" alt="Delete" width="16" height="16">
                                        </button>
                                    </form>
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                        </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Categeory List</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>NAME </th>
                            <th>SUBCATEGORY</th>
                            <th>DESCRIPTION</th>

                            <th style="margin-left: 30px !important;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                    @if(is_array($getcategories) && count($getcategories) > 0)
                        @foreach($getcategories as $getcategory)
                            <tr>
                                <td>{{ $getcategory['_id'] ?? 'null' }}</td>
                                <td>{{ $getcategory['categoryName'] ?? 'null' }}</td>
                                <td>
                                    @if(isset($getcategory['subcategories']) && is_array($getcategory['subcategories']))
                                        @foreach($getcategory['subcategories'] as $subcategory)
                                            {{ $subcategory['subcategoryName'] }} - {{ $subcategory['description'] }}<br>
                                        @endforeach
                                    @else
                                        No subcategories
                                    @endif
                                </td>
                                <td>{{ $getcategory['description'] ?? 'null' }}</td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                       
                                    <form action="{{ route('category.show', ['id' => $getcategory['_id']]) }}" method="GET">
                                        <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="More Info">
                                            <img src="{{ asset('images/edit.png') }}" alt="" width="16" height="16">
                                        </button>
                                    </form>


                                <form action="{{ route('category.edit', ['id' => $getcategory['_id']]) }}" method="GET">
                                        <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Edit Category">
                                            <img src="{{ asset('images/edit2.png') }}" alt="" width="16" height="16">
                                        </button>
                                    </form>



                                  <form action="{{ route('category.delete', ['id' => $getcategory['_id']]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Delete">
                                                <img src="{{ asset('images/trash-solid.png') }}" alt="Delete" width="16" height="16">
                                            </button>
                                </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">No categories found.</td>
                        </tr>
                    @endif


                        </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>





</div>



@endsection


@section('scripts')

@endsection

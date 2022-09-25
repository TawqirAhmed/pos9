<div>

    @section('title','Products')

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ env('App_NAME') }}</a></li>
                                <li class="breadcrumb-item active">Product</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Product</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <!-- stert Content -->

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">Products</h3>
                        </div>
                        <div class="col-6">
                            <a type="button" class="btn btn-outline-success waves-effect width-md float-right" href="{{ route('products_add') }}" >New Product</a>
                        </div> 
                    </div>             
                </div>
                <div class="card-body">
                    <div class="box-body">
                        <div class="col-12">
                            <div class="card-box">
                                
                                <div class="row">
                                    <label for="paginate" style="margin-top: auto;">Show</label>
                                    <div class="col-sm-2">
                                        <select id="paginate" name="paginate" class="form-control input-sm" wire:model="paginate">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>  
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-3">
                                        <input type="search" wire:model="search" class="form-control input-sm" placeholder="Search By Name, SKU, Modified By">
                                    </div>
                                </div>
                                <br>

                                <table class="table table-bordered dt-responsive nowrap data-table-categories" width="100%">
                                    <thead>
                                    <tr>
                                        <tr id="" style="text-align: center;">
                                            <th rowspan="2" style="overflow-wrap: anywhere;">S/N</th>
                                            <th rowspan="2" style="overflow-wrap: anywhere;">Image</th>
                                            <th rowspan="2" style="overflow-wrap: anywhere;">Name</th>
                                            <th rowspan="2" style="overflow-wrap: anywhere;">SKU</th>
                                            <th rowspan="2" style="overflow-wrap: anywhere;">Category</th>
                                            <th rowspan="2" style="overflow-wrap: anywhere;">Description</th>
                                            <th colspan="3">Price</th>
                                            <th colspan="3">Stock</th>
                                            <th rowspan="2" style="overflow-wrap: anywhere;">Modified By</th>
                                            <th rowspan="2" style="overflow-wrap: anywhere;">Modified Date</th>
                                            <th rowspan="2" style="overflow-wrap: anywhere;">Action</th>
                                         </tr>
                                         <tr  style="text-align: center;">
                                            <th style="overflow-wrap: anywhere;">Buy</th>
                                            <th style="overflow-wrap: anywhere;">Sell</th>
                                            <th style="overflow-wrap: anywhere;">Discount %</th>
                                            <th style="overflow-wrap: anywhere;">New</th>
                                            <th style="overflow-wrap: anywhere;">Out</th>
                                            <th style="overflow-wrap: anywhere;">Total</th>
                                         </tr>
                                    </tr>
                                    </thead>
                                        
                                    <tbody>
                                        @foreach ($products as $key=>$value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/products') }}/{{ $value->image }}">
                                                </td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->sku }}</td>
                                                <td>{{ $value->category->name }}</td>
                                                <td>{{ $value->description }}</td>
                                                <td>{{ $value->buy }}</td>
                                                <td>{{ $value->sell }}</td>
                                                <td>{{ $value->discount }}</td>
                                                <td>{{ $value->new }}</td>
                                                <td>{{ $value->out }}</td>
                                                <td>{{ $value->stock }}</td>
                                                <td>{{ $value->user->name }}</td>
                                                <td>{{ $value->updated_at }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                      <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-cogs"></i>
                                                      </button>
                                                      <div class="dropdown-menu dropdown-menu-right"  style="color: white;">

                                                        <a href="{{ route('barcode',$value->id) }}" class="btn btn-info btn-sm dropdown-item" id="edit-barcode" target="_blank"><i class="fas fa-print"></i> Barcode</a>

                                                        <a href="{{ route('new_stock',$value->id) }}" class="btn btn-success btn-sm dropdown-item" id="edit-stock"><i class="fas fa-arrow-up"></i> Add New Stock</a>

                                                        <a href="{{ route('products_edit',$value->id) }}" class="btn btn-warning btn-sm dropdown-item" id="edit-products"><i class="fas fa-pen-fancy"></i> Edit Product</a>

                                                      </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $products->links() }}
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>
            </div>
            
            <!-- end Content -->

        </div> <!-- container -->

    </div> <!-- content -->

</div>

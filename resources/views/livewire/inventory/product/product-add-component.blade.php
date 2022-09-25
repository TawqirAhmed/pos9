<div>

    @section('title','Add New Product')

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
                                <li class="breadcrumb-item active">Add New Product</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add New Product</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <!-- stert Content -->

            <div class="card col-sm-6 offset-sm-3">
                <div>
                    <form role="form" enctype="multipart/form-data" wire:submit.prevent="Store()">
                        @csrf
                        <!--=====================================
                            MODAL HEADER
                        ======================================-->  
                          <div class="modal-header" style="color: white">
                            <h4 class="modal-title">Add New Product</h4>
                            {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                            
                          </div>
                          <!--=====================================
                            MODAL BODY
                          ======================================-->
                          <div class="modal-body">
                            <div class="box-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group">          
                                    <div class="input-group">             
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Name:</strong>
                                        <input type="text" class="form-control input-lg" name="name" placeholder="Product Name" required wire:model="name">
                                      </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">      
                                    <div class="input-group">                 
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>SKU:</strong>
                                        <input type="text" class="form-control input-lg" name="sku" placeholder="SKU"  required wire:model="sku">
                                      </div>
                                    </div>
                                </div>

                                <div class="form-group">      
                                    <div class="input-group">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Category:</strong>
                                            <select class="form-control input-sm" name="category" placeholder="Category"  required wire:model="category_id">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $key=>$value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select> 
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">                 
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Description:</strong>
                                        <textarea type="text" class="form-control input-lg" name="description" placeholder="Description" required wire:model="description"></textarea>
                                      </div>
                                    </div>
                                </div>

                                <div class="form-group">      
                                    <div class="input-group">                 
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Buying Price:</strong>
                                        <input type="number" class="form-control input-lg" name="buy" placeholder="Buying Price" min="0" required wire:model="buy">
                                      </div>
                                    </div>
                                </div>

                                <div class="form-group">      
                                    <div class="input-group">                 
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Selling Price:</strong>
                                        <input type="number" class="form-control input-lg" name="sell" placeholder="Selling Price" min="0" required wire:model="sell">
                                      </div>
                                    </div>
                                </div>

                                <div class="form-group">      
                                    <div class="input-group">                 
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Discount %:</strong>
                                        <input type="number" class="form-control input-lg" name="discount" placeholder="Discount %" min="0" required wire:model="discount">
                                      </div>
                                    </div>
                                </div>

                                <div class="form-group">      
                                    <div class="input-group">                 
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>New Product Quantity:</strong>
                                        <input type="number" class="form-control input-lg" name="new" placeholder="New Product Quantity" min="0" required wire:model="new">
                                      </div>
                                    </div>
                                </div>

                                <div class="form-group">      
                                    <div class="input-group">                 
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Image:</strong>
                                        <input type="file" class="input-file input-md" wire:model="image">
                                        <br><br>
                                        @if($image)
                                            <img src="{{ $image->temporaryUrl() }}" width="120">
                                        @endif
                                      </div>
                                    </div>
                                </div>
                              
                            </div>
                          </div>
                          <!--=====================================
                            MODAL FOOTER
                          ======================================-->
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success waves-effect waves-light">Add</button>
                            {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> --}}
                          </div>
                    </form>
                </div>


            </div>
            
            <!-- end Content -->

        </div> <!-- container -->

    </div> <!-- content -->

</div>

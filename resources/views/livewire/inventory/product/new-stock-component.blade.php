<div>

    @section('title','Blank')

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
                                <li class="breadcrumb-item active">Add New Stock</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add New Stock</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <!-- stert Content -->

            <div class="card col-sm-6 offset-sm-3">
                <div>
                    <form role="form" enctype="multipart/form-data" wire:submit.prevent="Update()">
                    @csrf
                    <!--=====================================
                        MODAL HEADER
                    ======================================-->  
                      <div class="modal-header" style="color: white">
                        <h4 class="modal-title">Add New Stock</h4>
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
                                    <input type="text" class="form-control input-lg" name="product_name" placeholder="Product Name" wire:model="product_name" readonly>
                                  </div>
                                </div>
                            </div>
                            
                            

                            <div class="form-group">      
                                <div class="input-group">                 
                                  <div class="col-xs-12 col-sm-12 col-md-12">
                                    <strong>New Stock Quantity:</strong>
                                    <input type="number" class="form-control input-lg" name="qty" placeholder="New Stock Quantity" min="0" required wire:model="qty">
                                  </div>
                                </div>
                            </div>
                          
                        </div>
                      </div>
                      <!--=====================================
                        MODAL FOOTER
                      ======================================-->
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> --}}
                      </div>
                </form>
                </div>


            </div>
            
            <!-- end Content -->

        </div> <!-- container -->

    </div> <!-- content -->

</div>

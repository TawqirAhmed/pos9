<div>

    @section('title','Refunds')

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
                                <li class="breadcrumb-item active">Refunds</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Refunds</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <!-- stert Content -->

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">Rewfunds</h3>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-success waves-effect width-md float-right" data-toggle="modal" data-target="#modalAdd" data-overlaySpeed="200" data-animation="fadein">New Rewfund</button>
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
                                        <input type="search" wire:model="search" class="form-control input-sm" placeholder="Search By Customer, Bill No">
                                    </div>
                                </div>
                                <br>

                                <table class="table table-bordered dt-responsive nowrap data-table-categories" width="100%">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Customer</th>
                                        <th>Bill No</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Modified By</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                        @foreach ($refunds as $key=>$value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->sell->bill_no }}</td>
                                                <td>{{ $value->description }}</td>
                                                <td>{{ $value->amount }}</td>
                                                <td>{{ $value->user->name }}</td>
                                                <td>
                                                    <a type="button" class="btn btn-outline-warning waves-effect width-md" data-toggle="modal" data-target="#modalEdit" data-overlaySpeed="200" data-animation="fadein" wire:click="getItem({{ $value->id }})">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                                {{ $refunds->links() }}
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>
            </div>
            
            <!-- end Content -->

        </div> <!-- container -->

    </div> <!-- content -->


        <!--==========================
          =  Modal window for Add Content    =
          ===========================-->
        <!-- sample modal content -->
        <div wire:ignore.self id="modalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" enctype="multipart/form-data" wire:submit.prevent="Store()">
                        @csrf
                        <!--=====================================
                            MODAL HEADER
                        ======================================-->  
                          <div class="modal-header">
                            <h4 class="modal-title">Add Category</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
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

                                  <div class="form-group" wire:ignore>          
                                    <div class="input-group">             
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Name:</strong>
                                        <input type="text" class="form-control" name="name" placeholder="Name" required wire:model="name">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group" wire:ignore>          
                                    <div class="input-group">             
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Bill No:</strong>
                                        <input type="text" class="form-control" name="bill_no" placeholder="Bill No" required wire:model="bill_no">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">          
                                    <div class="input-group">             
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Description:</strong>
                                        <textarea class="form-control input-lg" name="description" placeholder="Description" required wire:model="description"></textarea>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group" wire:ignore>          
                                    <div class="input-group">             
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Amount:</strong>
                                        <input type="text" class="form-control" name="amount" placeholder="Amount" required wire:model="amount">
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            
                          </div>
                    </form>
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!--==========================
          =  Modal window for Edit Content    =
          ===========================-->
        <!-- sample modal content -->
        <div wire:ignore.self id="modalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" enctype="multipart/form-data" wire:submit.prevent="Update()">
                        @csrf
                        <!--=====================================
                            MODAL HEADER
                        ======================================-->  
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Category</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
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

                                  <div class="form-group" wire:ignore>          
                                    <div class="input-group">             
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Name:</strong>
                                        <input type="text" class="form-control" name="e_name" placeholder="Name" required wire:model="e_name">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group" wire:ignore>          
                                    <div class="input-group">             
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Bill No:</strong>
                                        <input type="text" class="form-control" name="e_bill_no" placeholder="Bill No" required wire:model="e_bill_no">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">          
                                    <div class="input-group">             
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Description:</strong>
                                        <textarea class="form-control input-lg" name="e_description" placeholder="Description" required wire:model="e_description"></textarea>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group" wire:ignore>          
                                    <div class="input-group">             
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Amount:</strong>
                                        <input type="text" class="form-control" name="e_amount" placeholder="Amount" required wire:model="e_amount">
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            
                          </div>
                    </form>
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

</div>

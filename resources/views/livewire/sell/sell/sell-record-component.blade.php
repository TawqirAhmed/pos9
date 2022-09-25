<div>

    @section('title','Sell Records')

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
                                <li class="breadcrumb-item active">Sell Records</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Sell Records</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <!-- stert Content -->

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">Sales</h3>
                        </div>
                         
                    </div>             
                </div>

                  <!-- /.card-header -->
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
                                        <input type="search" wire:model="search" class="form-control input-sm" placeholder="Search Bill Code, Customer, Customer Code, Seller">
                                    </div>
                                </div>
                                <br>

                                <table class="table table-bordered dt-responsive nowrap data-table-sales" width="100%">
                                    <thead>
                                     <tr id="" style="text-align: center;">
                                        <th>S/N</th>
                                        <th>Bill Code</th>
                                        <th>Customer</th>
                                        <th>Customer Code</th>
                                        <th>Seller</th>
                                        <th>Total</th>
                                        <th>Grand Total</th>
                                        <th>Method</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                     </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($sells as $key=>$value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->bill_no }}</td>
                                                <td>{{ $value->customer->name }}</td>
                                                <td>{{ $value->customer->code }}</td>
                                                <td>{{ $value->user->name }}</td>
                                                <td>{{ $value->net_price }}</td>
                                                <td>{{ $value->total_price }}</td>
                                                <td>{{ $value->payment_method->name }}</td>
                                                <td>{{ $value->paid }}</td>
                                                <td>{{ $value->due }}</td>
                                                <td>{{ $value->created_at }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                      <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-cogs"></i>
                                                      </button>
                                                      <div class="dropdown-menu dropdown-menu-right"  style="color: white;">
                                                        <a href="{{ route('print_invoice', $value->id) }}" class="btn btn-info btn-sm dropdown-item" target="_blank"><i class="fas fa-print"></i>&nbsp; Print Invoice</a>

                                                        {{-- {{ auth()->user()->user_type }} --}}

                                                        @if(!(auth()->user()->user_type === 'cashier'))
                                                        <a class="btn btn-success btn-sm dropdown-item" data-toggle="modal" data-target="#modalEdit" wire:click="getItem({{ $value->id }})"><i class="fas fa-arrow-up"></i>&nbsp; Due Adjust</a>

                                                        <a href="{{ route('sell_edit', $value->id) }}" class="btn btn-warning btn-sm dropdown-item" ><i class="fas fa-pen-fancy"></i>&nbsp; Edit Sale</a>
                                                        @endif

                                                      </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $sells->links() }}
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>
            </div>
            
            <!-- end Content -->

        </div> <!-- container -->

    </div> <!-- content -->


    <div id="modalEdit" wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" wire:submit.prevent="dueAdjust()" enctype="multipart/form-data">
                @csrf
                <!--=====================================
                    MODAL HEADER
                ======================================-->  
                  <div class="modal-header" style="color: white">
                    <h4 class="modal-title">Due Adjust</h4>
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
                        
                        <div class="form-group">          
                            <div class="input-group">             
                              <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Bill Code:</strong>
                                <input type="text" class="form-control input-sm" id="edit_bill_code_due" name="bill_no" placeholder="Bill Code" required readonly wire:model="bill_no">
                              </div>
                            </div>
                        </div>

                        <div class="form-group">          
                            <div class="input-group">             
                              <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Grand Total:</strong>
                                <input type="text" class="form-control input-sm" id="edit_total_price_due" name="total_price" placeholder="Total" required readonly wire:model="total_price">
                              </div>
                            </div>
                        </div>

                        <div class="form-group">          
                            <div class="input-group">             
                              <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Paid:</strong>
                                <input type="text" class="form-control input-sm" id="edit_paid_amount_due" name="paid" placeholder="Paid" required readonly wire:model="paid">
                              </div>
                            </div>
                        </div>

                        <div class="form-group">          
                            <div class="input-group">             
                              <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Due:</strong>
                                <input type="text" class="form-control input-sm" id="edit_amount_due_due" name="due" placeholder="Due" required readonly wire:model="due">
                              </div>
                            </div>
                        </div>

                        <div class="form-group">          
                            <div class="input-group">             
                              <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Paying:</strong>
                                <input type="number" class="form-control input-sm" id="edit_paying_due" name="paying" min="0" placeholder="Paying" required wire:model="paying">
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

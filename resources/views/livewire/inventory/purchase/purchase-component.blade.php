<div>

    @section('title','Product Purchase')

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
                                <li class="breadcrumb-item active">Product Purchase</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Product Purchase</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <!-- stert Content -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">Purchased List</h3>
                        </div>
                    </div>             
                </div>
                    <br>

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
                                        <input type="search" wire:model="search" class="form-control input-sm" placeholder="Search By Supplier, Referance, Modified By">
                                    </div>
                                </div>
                                <br>

                                <table class="table table-bordered dt-responsive nowrap data-table-purchase" width="100%">
                                    <thead>
                                     <tr id="" style="text-align: center;">
                                        <th>S/N</th>
                                        <th>Supplier</th>
                                        <th>Referance</th>
                                        <th>Total</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Date</th>
                                        <th>Modified By</th>
                                        <th>Action</th>
                                     </tr>
                                    </thead>

                                    <tbody>
                                        
                                        @foreach ($purchases as $key=>$value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->supplier->name }} : {{ $value->supplier->code }}</td>
                                                <td>{{ $value->referance }}</td>
                                                <td>{{ $value->total }}</td>
                                                <td>{{ $value->paid }}</td>
                                                <td>{{ $value->due }}</td>
                                                <td>{{ $value->purchase_date }}</td>
                                                <td>{{ $value->user->name }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                      <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-cogs"></i>
                                                      </button>
                                                      <div class="dropdown-menu dropdown-menu-right"  style="color: white;">
                                                        <a href="{{ route('edit_purchase', $value->id) }}" class="btn btn-info btn-sm dropdown-item" id="edit-purchase"><i class="fas fa-pen"></i> View or Edit</a>
                                                      </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $purchases->links() }}
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>
            </div>
        
            
            <!-- end Content -->

        </div> <!-- container -->

    </div> <!-- content -->

</div>

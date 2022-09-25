<div>

    @section('title','Profit')

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
                                <li class="breadcrumb-item active">Profit</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Profit</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <!-- stert Content -->

            <div class="container">
            
                <div class="card card-info">
                     <div class="card-header"><h3 class="card-title text-white">Pick A Date Range</h3></div>
                    <div class="card-body">
                        <form wire:submit.prevent="setDate()" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <label for="from" class="col-form-label">From</label>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control input-sm" id="from" name="temp_from" required wire:model="temp_from">
                                    </div>
                                    <label for="from" class="col-form-label">To</label>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control input-sm" id="to" name="temp_to" required wire:model="temp_to">
                                    </div>
                                        
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-success btn-md" name="viewReport" >View report</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
            </div>


        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                
                <h1 class="m-0 text-dark">Records From Date ({{ $from }}) To ({{ $to }})</h1>
                
              </div><!-- /.col -->
              
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->


        <div class="card">
            
          <div class="card-body">
             <div class="box-body">

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
                        <input type="search" wire:model="search" class="form-control input-sm" placeholder="Search By Bill code">
                    </div>
                </div>
                <br>

                <table class="table table-bordered table-striped dt-responsive tables" width="100%">
                  
                  <thead>
                    
                    <tr>
                      
                      <th class="text-center" style="width:10px">S/N</th>
                      <th class="text-center">Bill Code</th>
                      <th class="text-center">Profit</th>
                      <th class="text-center">Date</th>
                      <th class="text-center">Action</th>
                    </tr>

                  </thead>

                  <tbody>
                    @foreach($sales as $key=>$value)
                        <tr>
                            <td class="text-center">{{ $value->id }}</td>
                            <td class="text-center">{{ $value->bill_no }}</td>
                            <td class="text-right">{{ $value->profit }}</td>
                            <td class="text-center">
                                {{ Carbon\Carbon::parse($value->created_at)->toFormattedDateString() }}
                            </td>
                            <td>
                              {{-- <a href="{{ URL::to('profitsdetails/'.$row->p_bill_code) }}" class="btn btn-success btn-sm" target="_blank"><i class="mdi mdi-cash"></i></a> --}}
                              <a type="button" class="btn btn-outline-warning waves-effect width-md" data-toggle="modal" data-target="#modalProfit" data-overlaySpeed="200" data-animation="fadein" wire:click="getItem({{ $value->id }})">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>

                </table>
                {{ $sales->links() }}
              </div>
          </div>
        </div>
        <!--/table ends-->
                    
            <!-- end Content -->

        </div> <!-- container -->

    </div> <!-- content -->




        <!--==========================
          =  Modal window for Add Content    =
          ===========================-->
        <!-- sample modal content -->
        <div wire:ignore.self id="modalProfit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {{-- <form role="form" enctype="multipart/form-data" wire:submit.prevent="Store()">
                        @csrf --}}
                        <!--=====================================
                            MODAL HEADER
                        ======================================-->  
                          <div class="modal-header">
                            <h4 class="modal-title">Bill No: {{ $bill_no }}, Profit: {{ $profit }}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                          </div>
                          <!--=====================================
                            MODAL BODY
                          ======================================-->
                          <div class="modal-body">
                            <div class="box-body">
                                

                                <table class="table table-bordered table-striped dt-responsive tables" width="100%">
                                    <thead>
                                        <th>S/N</th>
                                        <th>Product</th>
                                        <th>Sold At</th>
                                        <th>QTY</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $key=>$value)
                                            <tr>
                                                <th>{{ $key+1 }}</th>
                                                <th>{{ $value->name }}</th>
                                                <th>{{ $value->price}}</th>
                                                <th>{{ $value->quantity }}</th>
                                            </tr>        
                                        @endforeach    
                                    </tbody>
                                </table> 
                                  
                              
                            </div>
                          </div>
                          <!--=====================================
                            MODAL FOOTER
                          ======================================-->
                          <div class="modal-footer">
                            {{-- <button type="submit" class="btn btn-success waves-effect waves-light">Add</button> --}}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            
                          </div>
                    {{-- </form> --}}
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

</div>

<div>

    @section('title','Report')

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
                                <li class="breadcrumb-item active">Report</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Report</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <!-- stert Content -->

            <section class="content">
              <div class="container-fluid">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h4  style="text-align: center;">Sells Report</h4>
                  </div> <!-- /.card-body -->
                  <div class="card-body">

                    <form action="sells_report" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row">
                              <label for="from" class="col-form-label">From</label>
                                <div class="col-md-3">
                                  <input type="date" class="form-control input-sm" id="from" name="from" required>
                                </div>
                                <label for="from" class="col-form-label">To</label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control input-sm" id="to" name="to" required>
                                </div>
                                  
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success btn-md" name="exportExcel" >Download Excel</button>
                                </div>
                            </div>
                        </div>
                    </form>


                  </div><!-- /.card-body -->
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <section class="content">
              <div class="container-fluid">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h4  style="text-align: center;">Due Sells Report</h4>
                  </div> <!-- /.card-body -->
                  <div class="card-body">

                    <form action="due_sells_report" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row">
                              <label for="from" class="col-form-label">From</label>
                                <div class="col-md-3">
                                  <input type="date" class="form-control input-sm" id="from" name="from" required>
                                </div>
                                <label for="from" class="col-form-label">To</label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control input-sm" id="to" name="to" required>
                                </div>
                                  
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success btn-md" name="exportExcel" >Download Excel</button>
                                </div>
                            </div>
                        </div>
                    </form>


                  </div><!-- /.card-body -->
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <section class="content">
              <div class="container-fluid">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h4  style="text-align: center;">Customer's Purchase Report</h4>
                  </div> <!-- /.card-body -->
                  <div class="card-body">

                    <form action="customers_purchase_report" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row col-xs-12">
                              <label for="from" class="col-form-label" style="margin-right: 10px;">From</label>
                                <div class="col-xs-3" style="margin-right: 20px;">
                                  <input type="date" class="form-control input-sm" id="from" name="from" required>
                                </div>
                                <label for="from" class="col-form-label" style="margin-right: 10px;">To</label>
                                <div class="col-xs-3" style="margin-right: 20px;">
                                    <input type="date" class="form-control input-sm" id="to" name="to" required>
                                </div>

                                @php
                                  $customers = DB::table('customers')->get();
                                @endphp

                                <div class="col-xs-3" style="margin-right: 20px;">
                                    <select class="form-control" id="cus_pur_report" name="customer_id"  required>
                                      <option value="" disable selected>Select Customer</option>
                                        @foreach($customers as $cus)
                                          <option value="{{ $cus->id }}"> {{ $cus->id }} : {{ $cus->name }} : {{ $cus->code }}</option>
                                        @endforeach
                                      </select>
                                </div>
                                  
                                <div class="col-xs-3" style="margin-right: 20px;">
                                    <button type="submit" class="btn btn-success btn-md" name="exportExcel" >Download Excel</button>
                                    
                                </div>
                            </div>
                        </div>
                    </form>


                  </div><!-- /.card-body -->
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <section class="content">
              <div class="container-fluid">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h4  style="text-align: center;">Purchase Report</h4>
                  </div> <!-- /.card-body -->
                  <div class="card-body">

                    <form action="purchase_report" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row">
                              <label for="from" class="col-form-label">From</label>
                                <div class="col-md-3">
                                  <input type="date" class="form-control input-sm" id="from" name="from" required>
                                </div>
                                <label for="from" class="col-form-label">To</label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control input-sm" id="to" name="to" required>
                                </div>
                                  
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success btn-md" name="exportExcel" >Download Excel</button>
                                </div>
                            </div>
                        </div>
                    </form>


                  </div><!-- /.card-body -->
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <section class="content">
              <div class="container-fluid">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h4  style="text-align: center;">Expenses Report</h4>
                  </div> <!-- /.card-body -->
                  <div class="card-body">

                    <form action="expenses_report" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row">
                              <label for="from" class="col-form-label">From</label>
                                <div class="col-md-3">
                                  <input type="date" class="form-control input-sm" id="from" name="from" required>
                                </div>
                                <label for="from" class="col-form-label">To</label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control input-sm" id="to" name="to" required>
                                </div>
                                  
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success btn-md" name="exportExcel" >Download Excel</button>
                                </div>
                            </div>
                        </div>
                    </form>


                  </div><!-- /.card-body -->
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <section class="content">
              <div class="container-fluid">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h4  style="text-align: center;">Refunds Report</h4>
                  </div> <!-- /.card-body -->
                  <div class="card-body">

                    <form action="refunds_report" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row">
                              <label for="from" class="col-form-label">From</label>
                                <div class="col-md-3">
                                  <input type="date" class="form-control input-sm" id="from" name="from" required>
                                </div>
                                <label for="from" class="col-form-label">To</label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control input-sm" id="to" name="to" required>
                                </div>
                                  
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success btn-md" name="exportExcel" >Download Excel</button>
                                </div>
                            </div>
                        </div>
                    </form>


                  </div><!-- /.card-body -->
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <section class="content">
              <div class="container-fluid">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h4  style="text-align: center;">Profits Report</h4>
                  </div> <!-- /.card-body -->
                  <div class="card-body">

                    <form action="profits_report" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row">
                              <label for="from" class="col-form-label">From</label>
                                <div class="col-md-3">
                                  <input type="date" class="form-control input-sm" id="from" name="from" required>
                                </div>
                                <label for="from" class="col-form-label">To</label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control input-sm" id="to" name="to" required>
                                </div>
                                  
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success btn-md" name="exportExcel" >Download Excel</button>
                                </div>
                            </div>
                        </div>
                    </form>


                  </div><!-- /.card-body -->
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <section class="content">
              <div class="container-fluid">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h4  style="text-align: center;">Excel Lists</h4>
                  </div> <!-- /.card-body -->
                  <div class="card-body">

                    <a href="{{ route('customer_list') }}" class="btn btn-success">All Customers</a>

                    <a href="{{ route('supplier_list') }}" class="btn btn-success ml-2" >All Suppliers</a>
                    
                  </div><!-- /.card-body -->
                </div>
              </div><!-- /.container-fluid -->
            </section>
            
            <!-- end Content -->

        </div> <!-- container -->

    </div> <!-- content -->

</div>

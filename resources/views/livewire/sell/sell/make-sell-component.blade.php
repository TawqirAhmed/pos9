<div>

    @section('title','Make Sell')

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
                                <li class="breadcrumb-item active">Make Sell</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Make Sell</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <!-- stert Content -->

            <div class="row">

                <!-- Invoice -->
                <div class="col-lg-5 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="card-title">Invoice</h3>
                                </div>
                            </div>             
                        </div>
                        <br>
                        <div class="col-12">
                            <table class="table table-bordered nowrap" width="100%">
                                <thead style="text-align: center;">
                                <tr>
                                    <th width="25%">Product</th>
                                    <th width="15%">Price</th>
                                    <th width="15%">Quantity</th>
                                    <th width="10%">Total</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($product_list as $key=>$value)
                                        
                                        <tr>
                                            <td data-th="Product">
                                                {{ $value['name'] }}
                                            </td>
                                            <td data-th="price">
                                                {{ $value['price'] }}
                                            </td>
                                            <td data-th="Quantity">
                                                <input type="number" value="{{ $value['quantity'] }}" class="form-control input-sm" min="1"  wire:keyup="updateqty({{ $loop->index }}, $event.target.value)">
                                            </td>
                                            <td data-th="Total">
                                                {{ $value['price'] * $value['quantity'] }}
                                            </td>
                                            <td data-th="Action">
                                                <a class="btn btn-danger btn-sm" wire:click="remove({{ $loop->index }})">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>

                            <hr>
                            <form role="form" wire:submit.prevent="Store()" enctype="multipart/form-data">
                                @csrf

                                <div class="row text-center">
                                    <div class="col-md-9"></div>
                                    <div class="col-md-3">
                                        <strong> Subtotal</strong>
                                        <input class="form-control input-sm" name="sub_total" type="text" readonly wire:model="subTotal">
                                    </div>
                                </div>
                                <br>

                                <div class="row text-center">
                                    <div class="col-md-9"></div>
                                    <div class="col-md-3">
                                        <strong>Grand Total</strong>
                                        <input class="form-control input-sm" name="pur_total" type="text" readonly wire:model="Gtotal">
                                    </div>
                                </div>
                                <br>

                                <div class="row text-center">
                                    <div class="col-md-9"></div>
                                    <div class="col-md-3">
                                        <strong>Paid Amount</strong>
                                        <input class="form-control input-sm" name="paid_amount" type="number" required wire:model="paid" step="any">
                                    </div>
                                </div>
                                <br>

                                <div class="row">

                                    <div class="col-md-4" wire:ignore>
                                        <strong>Payment Method</strong>
                                        <select id="sale_payment_method" class="form-control input-sm" name="payment_method_id" placeholder="Payment Method"  required wire:model="payment_method_id">
                                            <option value="" selected disabled>Payment Method</option>
                                            @foreach($payment_methods as $key=>$value)
                                              <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach  
                                        </select>
                                    </div>

                                    
                                    <div class="col-md-5"  wire:ignore wire:key="select-field-model-version-{{ $iteration }}">
                                        <strong>Customer</strong>
                                        <select  id="select-customer" class="form-control input-sm" name="customer_id" placeholder="Select Customer" required wire:model="customer_id">
                                            <option value="" selected disabled>Select customer</option>
                                            @foreach($customers as $key=>$value)
                                              <option value="{{ $value->id }}">{{ $value->id }} : {{ $value->name }} : {{ $value->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <button style="margin-top: 16px" type="button" class="btn btn-outline-success waves-effect width-md float-right" data-toggle="modal" data-target="#modalAdd" data-overlaySpeed="200" data-animation="fadein">New Customer</button>
                                    </div>
                                    
                                </div>
                                <br>

                                <div class="row">
                                    <button style="margin: auto;" type="submit" class="btn btn-success waves-effect waves-light" style="margin-right: 5px">Store Sale</button>
                                </div>
                                <br>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- Invoice -->

                

                <!-- Products -->
                <div class="col-lg-7 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="card-title">Products</h3>
                                </div>
                            </div>             
                        </div>
                        <br>
                        <div class="col-12">
                            

                            <div class="row">

                            <label for="paginate" style="margin-top: auto;margin-left: auto;">Show</label>
                            <div class="col-sm-2">
                            <select id="paginate" name="paginate" class="form-control input-sm" wire:model="paginate">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            </div>  
                            <div class="col-sm-6">
                                <input type="text" wire:keydown.enter="barcodeAdd($event.target.value)" class="form-control input-sm" placeholder="Barcode" autofocus wire:model="barcode">
                            </div>
                            <div class="col-sm-3">
                                <input type="search" wire:model="search" class="form-control input-sm" placeholder="Search">
                            </div>
                            </div>
                            <br>
                            <table id="datatable-makesales" class="table table-bordered dt-responsive nowrap data-table-makesales" width="100%">
                                <thead style="text-align: center;">
                                <tr>
                                    <th >Image</th>
                                    <th >Name</th>
                                    <th >SKU</th>
                                    <th >Stock</th>
                                    <th >Selling Price</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($products as $kay=>$value)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('uploads/products') }}/{{ $value->image }}">
                                            </td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->sku }}</td>
                                            <td>{{ $value->stock }}</td>
                                            <td>{{ $value->sell }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-success waves-effect waves-light" wire:click="addToList('{{ $value->sku }}')">Add</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                {{ $products->links() }}
                        </div>
                    </div>
                </div>
                <!-- Products -->

            </div>
            
            <!-- end Content -->

        </div> <!-- container -->

    </div> <!-- content -->



    <!--==========================
      =  Modal window for Add Customers    =
      ===========================-->
    <!-- sample modal content -->
    <div wire:ignore.self id="modalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" wire:submit.prevent="StoreCustomer()" enctype="multipart/form-data">
                    @csrf
                    <!--=====================================
                        MODAL HEADER
                    ======================================-->  
                      <div class="modal-header" style="color: white">
                        <h4 class="modal-title">Add Customer Form</h4>
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
                                    <strong>Name:</strong>
                                    <input type="text" class="form-control input-lg" name="name" placeholder="Name" required wire:model="name">
                                  </div>
                                </div>
                              </div>
                              <!-- TAKING Amount -->
                              
                              <div class="form-group">      
                                <div class="input-group">                 
                                  <div class="col-xs-12 col-sm-12 col-md-12">
                                    <strong>Contact:</strong>
                                    <textarea type="text" class="form-control input-lg" name="contact" placeholder="Contact" required wire:model="contact"></textarea>
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



    @push('scripts')
        <script type="text/javascript">
            Livewire.on('customerUpdate', postId => {
            $(document).ready(function () {
                $('#select-customer').select2();
                $('#select-customer').on('change', function (e) {
                    var data = $('#select-customer').select2("val");
                    @this.set('customer_id', data);
                });
            });
            })

            $(document).ready(function () {
                $('#sale_payment_method').select2();
                $('#sale_payment_method').on('change', function (e) {
                    var data = $('#sale_payment_method').select2("val");
                    @this.set('payment_method_id', data);
                });
            });
        </script>
    @endpush


</div>

<div>

    @section('title','Edit Purchase')

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
                                <li class="breadcrumb-item active">Make Purchase</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Make Purchase</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <!-- stert Content -->

            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="card-title">Purchased Products (Referance No: {{ $edit_referance }})</h3>
                            </div>
                        </div>             
                    </div>
                    <br>


                    @php
                      $products = DB::table('products')->get();
                    @endphp

                    <div>
                        @if (session()->has('p_not_found'))
                            <div class="alert alert-warning">
                                {{ session('p_not_found') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">          
                        <div class="input-group"> 
                          <div class="col-xs-1 col-sm-1 col-md-1">  </div>          
                          <div class="col-xs-6 col-sm-6 col-md-6" wire:ignore>
                              <select  id="select-product" class="form-control input-sm" name="suppliers_id" placeholder="Select Product" wire:model="newProduct">
                                    <option value="" selected disabled>Select Product</option>
                                    @foreach($products as $prod)
                                      <option value="{{ $prod->name }} :{{ $prod->sku }}"> {{ $prod->name }} : {{ $prod->sku }}</option>
                                    @endforeach
                                </select> 
                          </div>

                          <div class="col-xs-5 col-sm-5 col-md-5">
                            <button type="submit" class="btn btn-success waves-effect waves-light" style="margin-right: 20px" wire:click="addProduct">Add</button>
                          </div>

                        </div>
                    </div>


                    <div class="card-body">
                    <div class="box-body">
                        <div class="col-12">
                            <div class="card-box">
                                <table class="table table-bordered nowrap" width="100%">
                                    <thead style="text-align: center;">
                                    <tr>
                                        <th width="5%">S/N</th>
                                        <th width="25%">Product</th>
                                        <th width="10%">SKU</th>
                                        <th width="15%">Price</th>
                                        <th width="15%">Quantity</th>
                                        <th width="10%">Total</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        
                                        @foreach($pProducts as $pProduct)

                                            <tr>
                                                <td data-th="S/N">
                                                    {{ $pProduct['id'] }}
                                                </td>
                                                <td data-th="Product">
                                                    {{ $pProduct['name'] }}
                                                </td>
                                                <td data-th="SKU">
                                                    {{ $pProduct['sku'] }}
                                                </td>
                                                <td data-th="price">
                                                    <input type="number" value="{{ $pProduct['price'] }}" class="form-control" min="0" wire:keyup="updateprice({{ $loop->index }}, $event.target.value)">
                                                </td>
                                                <td data-th="Quantity">
                                                    <input type="number" value="{{ $pProduct['quantity'] }}" class="form-control" min="0" wire:keyup="updateqty({{ $loop->index }}, $event.target.value)">
                                                </td>
                                                <td data-th="Total">
                                                    {{ $pProduct['price'] * $pProduct['quantity'] }}
                                                </td>
                                                <td data-th="Action">
                                                    <a class="btn btn-danger btn-sm" wire:click="remove({{ $loop->index }})">Remove</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>

                            <form role="form" wire:submit.prevent="Store()"  enctype="multipart/form-data">
                            @csrf
                            
                                {{-- <input type="hidden" name="all_products" value="<?php echo htmlspecialchars(json_encode($pProducts)); ?>"> --}}

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
                                        <strong>paid</strong>
                                        <input class="form-control input-sm" type="number" name="paid" placeholder="Paid Amount" required wire:model="paid">
                                    </div>
                                </div>

                                <div class="row text-center">
                                    @php
                                      $suppliers = DB::table('suppliers')->get();
                                    @endphp

                                    <div class="col-md-9"></div>
                                    <div class="col-md-3" wire:ignore>
                                        <strong>Supplier</strong>
                                        <select  id="select-supplier" class="form-control input-sm" name="suppliers_id" placeholder="Select Supplier" required wire:model="supplier_id">
                                            <option value="" selected disabled>Select Supplier</option>
                                            @foreach($suppliers as $cus)
                                              <option value="{{ $cus->id }}">{{ $cus->id }} : {{ $cus->name }} : {{ $cus->code }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>

                                <div class="row text-center">
                                    <div class="col-md-9"></div>
                                    <div class="col-md-3">
                                        <strong>Purchase Date</strong>
                                        <input type="date" class="form-control input-sm" name="purchase_date" placeholder="Purchase Date" required wire:model="purchase_date">
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <button style="margin: auto;" type="submit" class="btn btn-success waves-effect waves-light" style="margin-right: 5px">Store Purchase</button>
                                </div>
                            </form>

                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>

                </div>
            </div>
 
            
            <!-- end Content -->

        </div> <!-- container -->

    </div> <!-- content -->



    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#select-product').select2();
                $('#select-product').on('change', function (e) {
                    var data = $('#select-product').select2("val");
                    @this.set('newProduct', data);
                });
            });

            $(document).ready(function () {
                $('#select-supplier').select2();
                $('#select-supplier').on('change', function (e) {
                    var data = $('#select-supplier').select2("val");
                    @this.set('supplier_id', data);
                });
            });

        </script>
    @endpush

</div>

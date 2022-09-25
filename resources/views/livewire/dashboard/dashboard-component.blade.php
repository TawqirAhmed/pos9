@extends('livewire.base.base_extends')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<div>

    @section('title','Dashboard')

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
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <!-- stert Content -->

            <div class="col-md-6 offset-md-3">
                <div class="card">
                    
                    <div class="card-body">

                        <form action="{{ route('customChart') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <strong>From</strong>
                                        <input type="date" class="form-control input-sm" name="from" required>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <strong>To</strong>
                                        <input type="date" class="form-control input-sm" name="to" required>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <br>
                                    <button type="submit" class="btn btn-success"> Submit</button>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>
            </div>

            <h2>Records From Date ({{ $request_from }}) To ({{ $request_to }})</h2>

            <div class="row">

                <div class="col-xl-4 col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title mb-3">Daily Sales</h4>
                        <div class="chartjs-chart-example chartjs-chart">
                            <canvas id="salesChart"></canvas>    
                        </div>            
                    </div> <!-- end card-box -->
                </div> <!-- end col -->

                <div class="col-xl-4 col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title mb-3">Top Products</h4>
                        <div class="chartjs-chart-example chartjs-chart">
                            <canvas id="topProducts"></canvas>    
                        </div>            
                    </div> <!-- end card-box -->
                </div> <!-- end col -->

                <div class="col-xl-4 col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title mb-3">Lowest Sold Products</h4>
                        <div class="chartjs-chart-example chartjs-chart">
                            <canvas id="lowProducts"></canvas>    
                        </div>            
                    </div> <!-- end card-box -->
                </div> <!-- end col -->

            </div>

            <!-- end Content -->

        </div> <!-- container -->

    </div> <!-- content -->

    

        @include('livewire.dashboard.dashboard_js')

    

</div>
@endsection
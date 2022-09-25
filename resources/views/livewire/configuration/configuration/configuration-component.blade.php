<div>

    @section('title','Configuration')

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
                                <li class="breadcrumb-item active">Configuration</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Configuration</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <!-- stert Content -->



            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Configuration</h4>

                        <div class="row">
                            <div class="col-sm-2">
                                <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical" wire:ignore>
                                    <a class="nav-link active show mb-2" id="v-pills-vat-tab" data-toggle="pill" href="#v-pills-vat" role="tab" aria-controls="v-pills-vat"
                                        aria-selected="true">
                                        <i class="fas fa-coins"></i>&nbsp;&nbsp; VAT</a>
                                    <a class="nav-link mb-2" id="v-pills-company-info-tab" data-toggle="pill" href="#v-pills-company-info" role="tab" aria-controls="v-pills-company-info"
                                        aria-selected="false">
                                        <i class="fas fa-store"></i>&nbsp;&nbsp; Company/Shop Info</a>
                                    <a class="nav-link mb-2" id="v-pills-logo-tab" data-toggle="pill" href="#v-pills-logo" role="tab" aria-controls="v-pills-logo"
                                        aria-selected="false">
                                        <i class="fas fa-image"></i>&nbsp;&nbsp; Logo</a>
                                </div>
                            </div> <!-- end col-->
                            <div class="col-sm-10">
                                <div class="tab-content pt-0" wire:ignore>
                                    
                                    @include('livewire.configuration.configuration.vat')

                                    @include('livewire.configuration.configuration.company_info')

                                    @include('livewire.configuration.configuration.logo')
                                    
                                </div>
                            </div> <!-- end col-->
                        </div> <!-- end row-->
                        
                    </div> <!-- end card-box-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->


            
            <!-- end Content -->

        </div> <!-- container -->

    </div> <!-- content -->

</div>

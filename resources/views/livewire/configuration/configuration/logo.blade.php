<div class="tab-pane fade" id="v-pills-logo" role="tabpanel" aria-labelledby="v-pills-logo-tab" wire:ignore.self>
    
    <div class="col-lg-12">
        <div class="card-box">

            <ul class="nav nav-tabs nav-bordered">
                <li class="nav-item">
                    <a href="#logo-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                        Logo
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#logo-sm-b1" data-toggle="tab" aria-expanded="true" class="nav-link">
                        Logo Sm
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#favicon-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                        Favicon
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                
                @include('livewire.configuration.configuration.logo_main')

                @include('livewire.configuration.configuration.logo_sm')

                @include('livewire.configuration.configuration.favicon')

            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col -->    


</div>
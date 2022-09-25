<div class="tab-pane show active" id="logo-b1" wire:ignore.self>
    
	<div class="col-md-8 offset-md-2">
        <form role="form" enctype="multipart/form-data" wire:submit.prevent="LogoMain()">
            @csrf
            <!--=====================================
                MODAL HEADER
            ======================================-->  
              <div class="modal-header" style="color: white">
                <h4 class="modal-title">Main Logo</h4>
                {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                
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
                            <strong>Logo:</strong>

                            <input type="file" class="input-file input-md" wire:model="new_logo" onchange="readURLLogo(this);">

                            {{-- @if($new_logo)
                                <img src="{{ $new_logo->temporaryUrl() }}" width="120">
                            @else
                            	<img src="{{ asset('assets/images') }}/{{ $logo }}" width="120">
                            @endif --}}
                            <img id="image-logo" src="{{ asset('assets/images') }}/{{ $logo }}" width="120">
                            

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
                {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> --}}
              </div>
        </form>
    </div>



    @push('scripts')
        <script type="text/javascript">
            function readURLLogo(input){
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#image-logo')
                            .attr('src', e.target.result)
                            .width(120)
                            .hight(80)
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush


</div>
<div class="tab-pane" id="favicon-b1" wire:ignore.self>
    <div class="col-md-8 offset-md-2">
        <form role="form" enctype="multipart/form-data" wire:submit.prevent="Favicon()">
            @csrf
            <!--=====================================
                MODAL HEADER
            ======================================-->  
              <div class="modal-header" style="color: white">
                <h4 class="modal-title">Favicon</h4>
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
                            <strong>Favicon:</strong>

                            <input type="file" class="input-file input-md" wire:model="new_favicon" onchange="readURLFavicon(this);">

                            {{-- @if($new_logo_sm)
                                <img id="image" src="{{ $new_logo_sm->temporaryUrl() }}" width="120">
                            @else
                                <img id="image" src="{{ asset('assets/images') }}/{{ $logo_sm }}" width="120">
                            @endif --}}

                            {{-- @if($new_logo_sm == null) --}}
                                <img id="image-favicon" src="{{ asset('assets/images') }}/{{ $favicon }}" width="120">
                           {{--  @else
                                <img id="image" src="{{ URL::to($new_logo_sm->photo ) }}" width="80px">
                            @endif --}}
                            

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
            function readURLFavicon(input){
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#image-favicon')
                            .attr('src', e.target.result)
                            .width(80)
                            .hight(80)
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
    
</div>
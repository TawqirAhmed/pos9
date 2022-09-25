<div class="tab-pane fade active show" id="v-pills-vat" role="tabpanel" aria-labelledby="v-pills-vat-tab" wire:ignore.self>
    
    
    <div class="col-md-8 offset-md-2">
        <form role="form" enctype="multipart/form-data" wire:submit.prevent="UpdateVAT()">
            @csrf
            <!--=====================================
                MODAL HEADER
            ======================================-->  
              <div class="modal-header" style="color: white">
                <h4 class="modal-title">VAT/Tax</h4>
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
                            <strong>VAT/Tax %:</strong>
                            <input type="number" min="0" max="100" class="form-control input-lg" name="vat" required wire:model="vat">
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

</div>
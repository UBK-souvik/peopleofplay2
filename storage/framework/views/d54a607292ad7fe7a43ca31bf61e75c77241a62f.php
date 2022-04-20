<style type="text/css">
.cropper-container.cropper-bg {
    width: 100% !important;
}
.cropper-wrap-box {
    background-color: #fff !important;
}
</style>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title cropperModelHeader" id="modalLabel">Crop image
                         <br>
                         <span>Extra Zoom In may cause the picture to pixelate.</span>
                         </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>

                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-12">  
                                    <!--  default image where we will set the src via jquery-->
                                    <img id="image" class="img-fluid">
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnZoomIn" class="btn btn-secondary"><i class="fa fa-search-plus" aria-hidden="true"></i> Zoom In</button>
                        <button type="button" id="btnZoomOut" class="btn btn-secondary"><i class="fa fa-search-minus" aria-hidden="true"></i> Zoom Out</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="crop">Crop <i class="fa fa-spinner fa-spin crop_laoder" style="display: none;"></i> </button>
                    </div>
                </div>
            </div>
        </div>
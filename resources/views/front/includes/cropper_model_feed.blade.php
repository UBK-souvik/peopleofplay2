<style type="text/css">
.cropper-container.cropper-bg {
    width: 100% !important;
}
.cropper-wrap-box {
    background-color: #fff !important;
}
</style>
        <div class="modal fade" id="modalfeedCropNew" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="z-index: 99999 !important;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title cropperModelHeader" id="modalLabel">Crop image
                         <br>
                         <span>Extra Zoom In may cause the picture to pixelate.</span>
                         </h5>
                        <button type="button" onclick="closeModelFeedCrooper(this);">
                            <span aria-hidden="true">×</span>
                        </button>

                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-12">  
                                    <!--  default image where we will set the src via jquery-->
                                    <img id="imagefeedCrop" class="img-fluid">
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="crop">Crop <i class="fa fa-spinner fa-spin crop_laoder" style="display: none;"></i> </button>
                    </div>
                </div>
            </div>
        </div>
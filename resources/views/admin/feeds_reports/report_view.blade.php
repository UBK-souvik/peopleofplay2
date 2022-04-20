<div class="modal-header">
   <button type="button" class="close" data-dismiss="modal">&times;</button>
   <h3>Feed Report View</h3>
</div>
<div class="modal-body">
    <form class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group">
            <div class="col-sm-12">
                <label for="value" class="col-sm-2 control-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Description">{{ $report_view->description }}</textarea>
            </div>
        </div>
    </form>
</div>
<style>
  .FeedFormSelected{
    box-shadow: 0px 2px 4px 1px #8c8c8ceb !important;
    border-radius: 12px !important;
  }
</style>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header PostHeader">
    <h4 class="modal-title">Add Post</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body PostBody">
      <div class="searchBox">
        <form method="POST" id="feedForm1">
          <div class="FormTextMessage">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                @csrf
                <select name="type" class="form-control FeedFormSelected" onchange="changeType(this)">
                  <option value="">Type of Post</option>
                  @foreach($feed_type as $ftype)
                  <option value="{{$ftype->id}}">{{$ftype->type}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="loadingType text-center" style="display: none;">
        <img src="{{ asset('front/images/ajax-loader-new.gif') }}" alt="profileimage" class="img-fluid">
      </div>
      <div class="ModelLoader Preloader">
         <img src="{{ asset('front/images/ajax-loader-new.gif') }}" alt="profileimage" class="img-fluid">
      </div>
      <div id="post_from_data">

      </div>
    </div>
  </div>
</div>
</div>
</div>
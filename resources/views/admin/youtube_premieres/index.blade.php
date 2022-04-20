@extends('admin.layouts.master')

@section('title') All Youtube Premieres @endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> All Youtube Premieres </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
    <li class="active">All Youtube Premieres </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  @include('admin.includes.info-box')
  <p>
    <a href="{{ route('admin.youtube-premieres.create') }}" class="btn btn-success">Create Youtube Premieres</a>
  </p>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <table class="table table-striped table-bordered table-hover dataTable" id="navigation-table">
            <thead>
             <tr>
              <th>URL</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.box -->
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
<script type="text/javascript">
	$(function() {
    $('#navigation-table').DataTable({
     "pageLength": 50,
     processing: true,
     serverSide: true,
     ajax: '{{ route("admin.youtube-premieres.list") }}',
     columns : [
     { "data": "url" },
     { "data": "status" },
     {
      "mRender": function (data, type, row)
      {
        return '<a href="{{ URL::to("admin/youtube-premieres/view") }}/'+row.id+'">\
        <i class="fa fa-eye fa-fw"></i>\
        </a>\
        <a href="{{ URL::to("admin/youtube-premieres/update") }}/'+row.id+'">\
        <i class="fa fa-edit fa-fw"></i>\
        </a>\
        <a class="delete_admins" href="{{ URL::to("admin/youtube-premieres/delete") }}/'+row.id+'">\
        <i class="fa fa-trash fa-fw"></i>\
        </a>';
      },
      orderable: false
    }
    ],
    order : [[0, 'asc']]
  });

    $('#navigation-table').on('click', '.delete_admins', function(e){
      e.preventDefault();
      var r = confirm("{{ adminTransLang('are_you_sure_to_delete') }}");
      if (r == false) {
        return false;
      }
      var href = $(this).attr('href');
      $.get( href, function( data ) {
        $('#navigation-table').DataTable().ajax.reload();
      });
    });
  });

</script>
@endsection

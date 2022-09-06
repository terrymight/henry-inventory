@include('customer.partials.header')

@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User List</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <a href="{{ url('users/create') }}">
              <button class="btn btn-primary">add dispatcher</button>
            </a>
          </ol>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">State with default Headers</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Dispatcher Name</th>
                    <th>Phone Number</th>
                    <th>Dispatcher State (s)</th>
                    <th>user status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($datas as $data)
                  <tr>
                    <td class="col-md-2">{{ $data->name }}</td>
                    <td class="col-md-2">{{ $data->phone }}</td>
                    <td class="col-md-2">{{ $data->email }}</td>
                    @if( $data->active == true )
                    <td class="col-md-2">
                      <span class="badge bg-success">Active</span>
                    </td>
                    @elseif( $data->active == false )
                    <td class="col-md-2">
                      <span class="badge bg-danger">Deactived</span>
                    </td>
                    @endif
                    <td class="project-actions text-right">
                      <a class="btn btn-primary btn-sm" href="{{ url('users/'.$data->id.'/show') }}">
                        <i class="fas fa-folder">
                        </i>
                        View
                      </a>
                      <a class="btn btn-info btn-sm" href="{{ url('users/'.$data->id.'/edit') }}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                      </a>
                      <a class="btn btn-danger btn-sm" data-category="{{ $data->id }}" data-toggle="modal" data-target="#deleteState">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                      </a>
                    </td>
                  </tr>
                  @endforeach
                  <th>Dispatcher Name</th>
                  <th>Phone Number</th>
                  <th>Dispatcher State (s)</th>
                  <th>user status</th>
                  <th></th>
                  </tr>
                  </tfoot>
              </table>
            </div>
            <!-- Delete Modal -->
            <div class="modal fade" id="deleteState" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteState" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                @isset ($data->id)
                <form method="POST" action="{{  url('users/destroy/'. $data->id) }}">
                  @method('DELETE')

                  @csrf

                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">This action is not reversible.</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete {{ $data->name }} ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                  </div>
                </form>
                @endisset
              </div>
            </div>

            @section('script')
            <script>
              $('#deleteState').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var action = button.data('action');
                var modal = $(this);
                modal.find('form').attr('action', action);
              });
            </script>
            @endsection
            <!-- /.Delete Modal -->
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



@include('customer.partials.footer')
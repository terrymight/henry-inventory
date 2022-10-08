@include('customer.partials.header')

@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dispatcher Details</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/users/list">User List</a></li>
            <li class="breadcrumb-item active">Dispatcher Details</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header data-->

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <a href="{{ url('assign/'.$id.'/create') }}">
              <button class="btn btn-primary">Assign State</button>
            </a>
          </ol>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Dispatcher Details</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Project Name</label>
              <br />{{ $data->name }}
            </div>
            <div class="form-group">
              <label for="inputDescription">Dispatcher Email</label>
              <br />{{ $data->email }}
            </div>
            <div class="form-group">
              <label for="inputStatus">Status</label>
              <br />
              @if($data->active == 1)
              <span class="badge bg-success">Active</span>
              @elseif($data->active == 0)
              <span class="badge bg-danger">Deactived</span>
              @endif
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Date Created</label>
              <br />{{ $data->created_at }}
            </div>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <!-- .States-->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">State Coverd</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table">
            <thead>
              <tr>
                <th>State Covering</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($covereds as $covered)
              <tr>
              <td>{{ $covered->state_name }}</td>          
                <td class="text-right py-0 align-middle">
                  <div class="btn-group btn-group-sm">
                    <button value="{{ $covered->dispatcher_id }}" class="btn btn-danger btn-sm deleteDataBtn" type="button">&nbsp;Delete&nbsp;<i class="fas fa-trash"></i></button>

                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.States -->
    </div>


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteState" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
  @isset ($data->id)
    <form method="POST" action="{{  url('dispatcher/destroy') }}">
      @method('POST')
      @csrf

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">This action is not reversible.</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="delete_id" id="delete_id">
          
          Are you sure you want to delete  ?
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
<!-- /.Delete Modal -->

@include('customer.partials.footer')
<script>
  $( document ).ready(function() {
    $('.deleteDataBtn').click(function(e){
      e.preventDefault();

      var data_id = $(this).val();
      $('#delete_id').val(data_id);

      $('#deleteModal').modal('show');
    });
  });  
</script>
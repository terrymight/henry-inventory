@include('customer.partials.header')

@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Order List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Customers Order List</li>

          </ol>

        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"></h1>
        </div><!-- /.col -->
        @if(Auth::user()->role_permission == 1 || Auth::user()->role_permission == 3 )
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <a href="{{ url('customer/create') }}">
              <button class="btn btn-primary">Create New Order</button>
            </a>
          </ol>
        </div><!-- /.col -->
        @endif
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Customers with default Headers</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th >#Invoice No</th>
                    <th >Name</th>
                    <th >Phone number </th>
                    <th >Product (s)</th>
                    <th >State</th>
                    <th >Price</th>
                    <th >Customer Address </th>
                    <th >Status</th>
                    <th class="col-2"></th>
                  </tr>
                </thead>
                <tbody>
                  @if ($datas != null)
                  @foreach ($datas as $data)
                  <tr>
                    <td>{{ $data->invoice_number }}</td>
                    <td>{{ $data->fullname }}</td>
                    <td>{{ $data->phone_number }}</td>
                    <td>
                      @foreach ($data->products as $product)
                      <li>{{ $product['pro'] }}</li>
                      @endforeach
                    </td>
                    <td>{{ $data->customer_state }}</td>
                    <td>{{ $data->total_cost_of_products }}</td>
                    
                    <td>{{ $data->customer_address }}</td>
                    
                    @if( $data->products_status == 'not processed' )
                    <td>
                      <span class="badge bg-primary">{{ $data->products_status }}</span>
                    </td>
                    @elseif ( $data->products_status == 'delivered' )
                    <td><span class="badge bg-success">{{ $data->products_status }}</span></td>
                    @elseif ( $data->products_status == 'processed' )
                    <span class="badge bg-warning">
                      <td><span class="badge bg-primary">{{ $data->products_status }}</span></td>
                      @elseif ( $data->products_status == 'rescheduled' )
                      <td><span class="badge bg-danger">{{ $data->products_status }}</span></td>
                      @elseif ( $data->products_status == 'canceled' )
                      <td><span class="badge bg-danger">{{ $data->products_status }}</span></td>
                      @endif

                      <td class="col-5">
                        <a class="btn btn-primary btn-sm" href="{{ url('customer/show/'.$data->id) }}">
                          <i class="fas fa-folder">
                          </i>
                          View
                        </a>
                        @if(Auth::user()->role_permission == 1 || Auth::user()->role_permission == 3 )
                        <a class="btn btn-info btn-sm" href="{{ url('customer/'.$data->id.'/edit') }}">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Edit
                        </a>
                        <button value="{{ $data->id }}" class="btn btn-danger btn-sm deleteDataBtn" type="button"><i class="fas fa-trash"></i>Delete</button>
                        @endif
                      </td>
                  </tr>
                  @endforeach
                @endif
                </tbody>
                <tfoot>
                  <tr>
                    <th>#Invoice No</th>
                    <th>Name</th>
                    <th>Phone number </th>
                    <th>Product (s)</th>
                    <th>State</th>
                    <th>Price</th>
                    <th >Customer Address </th> 
                    <th>Status</th>
                    <th class="col-md-6"></th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteCustomer" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                @isset ($data->id)
                <form method="POST" action="{{  url('customer/destroy') }}">
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
                      Are you sure you want to delete ?
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
<script>
  $( document ).ready(function() {
    $('.deleteDataBtn').click(function(e){
      e.preventDefault();

      var data_id = $(this).val();
      console.log(data_id);
      $('#delete_id').val(data_id);

      $('#deleteModal').modal('show');
    });
  });  
</script>
@include('customer.partials.header')

@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Customers List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Customers List</li>

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
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <a href="{{ url('customer/create') }}">
              <button class="btn btn-primary">add customer</button>
            </a>
          </ol>
        </div><!-- /.col -->

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
                    <th >Status</th>
                    <th class="col-2"></th>
                  </tr>
                </thead>
                <tbody>
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
                        @if(Auth::user()->role_permission == 1 || Auth::user()->role_permission == 2 )
                        <a class="btn btn-info btn-sm" href="{{ url('customer/'.$data->id.'/edit') }}">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Edit
                        </a>
                        <a class="btn btn-danger btn-sm" data-category="{{ $data->id }}" data-toggle="modal" data-target="#deleteCustomer">
                          <i class="fas fa-trash">
                          </i>
                          Delete
                        </a>
                        @endif
                      </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>#Invoice No</th>
                    <th>Name</th>
                    <th>Phone number </th>
                    <th>Product (s)</th>
                    <th>State</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th class="col-md-6"></th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
            <!-- Delete Modal -->
            <div class="modal fade" id="deleteCustomer" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteCustomer" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                @isset ($data->id)
                <form method="POST" action="{{  url('customer/destroy/'. $data->id) }}">
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
                      Are you sure you want to delete {{ $data->fullname }} ?
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
              $('#deleteCustomer').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var action = button.data('action');
                var modal = $(this);
                modal.find('form').attr('action', action);
              });
            </script>
            @endsection
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
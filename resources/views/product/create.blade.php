@include('customer.partials.header')

@include('sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('products/list') }}">Products List</a></li>
              <li class="breadcrumb-item active">Create</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- FORM SECTION -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Add Product Form</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- /.card-body -->
                <form method="POST" action="{{ $data->id ? url('products/'.$data->id) : url('products/store') }}">
                    @if ($data->id) @method('PUT') @endif
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <label>Enter Product :</label>
                                <input value="{{ old('name', $data->name) }}" id="name" name="name" type="text" class="form-control" placeholder="Enter Product to be added" required autofocus>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group">
                                <button class="btn btn-primary btn-sm"  type="submit">Submit</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  @include('customer.partials.footer')

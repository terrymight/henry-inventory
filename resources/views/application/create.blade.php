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
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Application Config Settings</h3>

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
                <form method="POST" action="{{ url('application/'.$data->id) }}">
                @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Application Name :</label>
                                    <input value="{{ old('company_name', $data->company_name) }}" id="company_name" name="company_name" type="text" class="form-control" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact Email : </label>
                                    <input type="email" class="form-control" value="{{ old('email', $data->email) }}" name="email" id="email" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact Phone :</label>
                                    <input value="{{ old('phone', $data->phone) }}" id="phone" name="phone" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact Phone 2 (optional): </label>
                                    <input type="phone" class="form-control" value="{{ old('phone_sec', $data->phone_sec) }}" name="phone_sec" id="phone_sec">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address :</label>
                                    <textarea class="form-control" name="address" id="address" cols="10" rows="3">{{ old('address', $data->address) }}</textarea>
                                    <!-- <input value="" id="address" name="address" type="text" class="form-control" required> -->
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm" type="submit">Submit</button>
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
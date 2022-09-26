@include('customer.partials.header')

@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Staff Form</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/staff/list') }}">Staff List</a></li>
                        <li class="breadcrumb-item active">Staff Create</li>
                    </ol>

                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Add Staff Form</h3>

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
                <form method="POST" action="{{ $data->id ? url('staff/'.$data->id) : url('staff/store') }}">
                    @if ($data->id) @method('PUT') @endif
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Customer Full Name : </label>
                                    <input type="text" class="form-control" value="{{ old('name', $data->name) }}" name="name" id="name" placeholder="Enter full name" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Number : </label>
                                    <input type="number" class="form-control" value="{{ old('phone', $data->phone) }}" id="phone" name="phone" placeholder="Enter staff phone" required>

                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password : </label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Set Dispatcher Password..." required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password : </label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repeat Password..." required>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Staff Email : </label>
                                    <input type="email" class="form-control" value="{{ old('email', $data->email) }}" id="email" name="email" placeholder="Enter staff email..." required>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm" type="submit">Create Now</button>
                            </div>
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
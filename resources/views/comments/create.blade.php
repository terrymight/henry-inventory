@include('customer.partials.header')

@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Comment Form</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/customers/list') }}">Customers List</a></li>
                        <li class="breadcrumb-item active">Comment Create</li>
                    </ol>

                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- FORM SECTION customer/store-->
           
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Add Comment Form </h3>

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
                <form method="POST" action="{{  url('comment/store') }}">
                   
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="invoice_id" value="{{ $invoice_id }}">
                                    <label>Comment : </label>
                                    <textarea name="comments_name" id="comments_name" class="form-control" rows="3" placeholder="Enter Comment note..." autofocus>{{ old('comments_name') }}</textarea>
                                </div>
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
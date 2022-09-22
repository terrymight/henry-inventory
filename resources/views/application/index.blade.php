@include('customer.partials.header')

@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Application Config</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">application config</li>

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
                            <h3 class="card-title">Application config Headers</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Application Name</th>
                                        <th>Contact Phone</th>
                                        <th>Business Reg</th>
                                        <th>Contact Phone 2</th>
                                        <th>Contact Email</th>
                                        <th>Contact Address</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                    <tr>
                                        <td class="col-md-2">
                                        
                                        {{ $data->company_name }}</td>
                                        <td class="col-md-2">{{ $data->phone }}</td>
                                        <td class="col-md-2">{{ $data->orders }}</td>
                                        <td class="col-md-2">{{ $data->phone_sec }}</td>
                                        <td class="col-md-2">{{ $data->email }}</td>
                                        <td class="col-md-2">{{ $data->address }}</td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-info btn-sm" href="{{ url('application/'.$data->id.'/edit') }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tr>
                                <tfoot>
                                    <tr>
                                        <th>Application Name</th>
                                        <th>Contact Phone</th>
                                        <th>Contact Phone 2</th>
                                        <th>Contact Email</th>
                                        <th>Contact Address</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteState" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteState" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                @isset ($data->id)
                                <form method="POST" action="{{  url('state/destroy/'. $data->id) }}">
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
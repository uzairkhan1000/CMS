@extends('layouts.master')

@section('content')
    <div class="container-fluid mt-2" style="width: 84%; float: right;">
        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body">
            <table class="table table-bordered" id="ajax-crud-datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Description</th>
                        <th>Assigned By</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <div class="container-fluid mt-2" style="width: 84%; float: right;">
        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body">
            <table class="table table-bordered" id="ajax-crud-datatable_2" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Description</th>
                        <th>Assigned By</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- boostrap company model -->
    <div class="modal fade" id="company-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="CompanyModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="CompanyForm" name="CompanyForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Assign To</label>
                            <div class="col-sm-12">
                                <select class="form-control form-select" id="assigned_to" name="assigned_to"
                                    aria-label="Default select example">
                                    
                                        
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#ajax-crud-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('csr/show_active_complaints') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'assigned_by',
                    name: 'assigned_by'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'assigned_to',
                    name: 'assigned_to'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            order: [
                [0, 'desc']
            ]
        });
    });
    
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#ajax-crud-datatable_2').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('csr/show_resolved_complaints') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'assigned_by',
                    name: 'assigned_by'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'assigned_to',
                    name: 'assigned_to'
                },
            ],
            order: [
                [0, 'desc']
            ]
        });
    });


    function editFunc(id) {
        if (confirm("Complaint Resoled?") == true) {
            var id = id;
            // ajax
            $.ajax({
                type: "POST",
                url: "{{ route('csr.resolve.complaint') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function (res) {
                    var oTable = $('#ajax-crud-datatable').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    }
</script>
@endsection
@extends('layouts.app')

@section('stylesheets')

{{-- datatables  --}}
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}">
{{-- reponsive datatables --}}
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/select.bootstrap4.min.css') }}">

{{-- sweet alert css --}}
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/sweet-alert/sweetalert2.min.css') }}">

@endsection

@section('content')


<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{-- Project Categories --}}
                <div class="pull-left" style="margin-top: 10px; margin-bottom: 0px;">
                    <h4>Projects of <strong><u>{{ $parentCategory -> name }}</u> <span style="color: #0099ff;">({{ ($parentType == 'main_cat') ? 'Main' : 'Sub' }})</span></strong></h4>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('projects.create', [$parentType, $parentCategory -> id]) }}"><i class="fa fa-plus"></i> New</a>
                    <a class="btn btn-primary" href="{{ ($parentType == 'main_cat') ? route('categories.index') : route('sub_categories.index', [$parentCategory -> category -> slug, $parentCategory -> category_id]) }}"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>

            <div class="card-body">

                <!-- session messages -->
                @include('partials._messages')

                @if(count($projects) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th width="80px">
                                <select id="multiple_select" class="custom-select m-b-5" width="100" name="multiple_select">
                                    <option value="0">action</option>
                                    <option value="1">delete</option>
                                </select>
                                <input type="checkbox" id="check_all"><label for="check_all" style="margin-bottom: 0px;">Check All</label>
                            </th>
                            <th>Sr.</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Detail</th>
                            <th width="80">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $key => $project)
                        <tr>
                            <td><input type="checkbox" class="checkbox checkbox-custom" data-id="{{$project->id}}"></td>
                            <td>{{ ++$key }}</td>
                            <td>{{ $project -> name }}</td>
                            <td>
                                <img src="{{ asset('images/projects/'. $project -> main_image) }}" width="100" height="100">
                            </td>
                            <td>{{ $project -> detail }}</td>

                            <td>
                                <a href="{{ route('projects.edit', [ $project -> id ]) }}" class="btn btn-primary btn-sm pull-left waves waves-effect" style="margin-right: 5px;" title="Edit"><i class="fa fa-wrench" title="Edit"></i></a>

                                <a href="javascript:void(0)" data-id="{{ $project-> id }}" class="sa-remove waves wave-effect btn btn-danger btn-sm pull-left" title="Delete"><i class="fa fa-trash"></i></a>


                                {!! Form::open(['route' => ['projects.destroy', $project -> id], 'method' => 'DELETE', 'id' => $project -> id]) !!}
                                <input type="submit" style="display: none; visibility: none;">
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="text-center">
                    <p>No records found.</p>
                </div>
                @endif
            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-12 text-center">
                <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to Main Categories</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')


<!-- Required datatable js -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.select.min.js') }}"></script>

<script>
    var table = $('.table').DataTable({
        "ordering": true,
        "sort": true,
        "paging": true,
    });
</script>

<script type="text/javascript" src="{{ asset('assets/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
<script>
    $('.sa-remove').click(function (e) {
        e.preventDefault();
        var value = $(this).attr('data-id');
        swal({
            title: "Are you sure ??",
            text: 'This will be deleted permanently.', 
            icon: "warning",
            buttons: true,
            showCancelButton: true,
            confirmButtonColor: '#d33',
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                // swal(value, 'success');
                $("#"+value).submit();
            }
        }); 
    });

</script>
<script>
  var url = 'delete-multiple-sub-categories';
</script>
<script type="text/javascript" src="{{ asset('js/custom/selectDeleteMultiple.js') }}"></script>
@endsection
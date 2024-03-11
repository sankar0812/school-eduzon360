@extends('layouts.default')
@section('title', 'Class Details')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')

    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Search Class & Section</h5>
    <div class="card mb-4">

        <div class="card-body">
            @if (auth()->user()->type == 'admin')
                <form action="{{ url('admin/marks/enter') }}" class="" method="get" enctype="multipart/form-data">
                @elseif (auth()->user()->type == 'staff')
                    <form action="{{ url('marks/enter') }}" class="" method="get" enctype="multipart/form-data">
                    @else
                    return redirect()->route('home');
            @endif



            <div class="form-group row mb-1">
                <label for="" class="col-sm-2 col-form-label">Class/Section</label>
                <div class="col-md-5">
                    <select class="form-select" id="country-dropdown" name="class_id" required>
                        <option value="" selected disabled hidden>select Class</option>
                        @foreach ($classdatas as $classdata)
                            <option value="{{ $classdata->id }}">
                                {{ $classdata->c_class }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary mt-2 "> <i class="bx bx-search fs-5 lh-0"></i>
                        Search</button>
                </div>
            </div>
            </form>
        </div>

    </div>


@endsection
@push('other-scripts')
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script> --}}
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js">
    </script>
@endpush

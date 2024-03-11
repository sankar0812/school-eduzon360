@extends('layouts.default')
@section('title', 'Exam Type')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')

<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Exam Type</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ url('/examtypes') }}" class="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInput" class=" py-3">Exam Type</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Exam Type"
                                    autocomplete="off" required>
                            </div>
                            <div class="form-check">
                                {{-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> --}}
                                {{-- <label class="form-check-label" for="exampleCheck1">Check me out</label> --}}
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card" style="padding: 12px;">
                    {{-- <h5 class="card-header">Exam Type
                        <a style="float:right;" href="{{ url('/examtypes/create') }}"
                            class="btn btn-outline-primary btn-sm">ADD</a>
                    </h5> --}}
                    <div class="row">
                        <div class="table-responsive text-nowrap">


                            <table class="table " id="example">

                                <thead class="">
                                    <tr class="text-info">
                                        <th>#</th>
                                        <th>Exam Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($examtypes as $type)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td> {{ $type->name }}</td>
                                            <td>
                                                @if ($type->id == 1)
                                                    {{-- <div class="dropdown">
                                                        <button class=" dropdown-toggle drop " id="dropdownMenuButton1"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-sharp fa-solid fa-bars"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('examtypes.edit', $type->id) }}">
                                                                    <i class="fa-solid fa-pen"></i> Edit
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div> --}}
                                                @else
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                      <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('examtypes.edit', $type->id) }}">
                                                                    <i class="fa-solid fa-pen"></i> Edit
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif

                                            </td>

                                        </tr>
                                    @endforeach



                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
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

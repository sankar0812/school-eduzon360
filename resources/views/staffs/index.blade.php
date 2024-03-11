@extends('layouts.default')
@section('title', 'Staff Details')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    ​
    @php
        $position = DB::table('staffpositions')
            ->select('sp_id', 'sp_name')
            ->get();
    @endphp
    ​

        <div class="card p-2">
            <div class="card-body">
                @if (auth()->user()->type == 'admin')
                    <form class="" action="{{ route('admin.positionfilter') }}" method="GET">
                    @elseif (auth()->user()->type == 'clerk')
                        <form class="" action="{{ route('clerkadmin.positionfilter') }}" method="GET">
                        @else
                            return redirect()->route('home');
                @endif


                <div class="form-group row mb-1">
                    <label for="inputPassword" class="col-sm-2 col-form-label">staff Postion</label>
                    <div class="col-md-5">
                        <select id="" name="staffposition" class="form-control" autocomplete="off" required>
                            <option value="" selected disabled hidden>Select Position</option>
                            @foreach ($position as $positiondata)
                                <option value="{{ $positiondata->sp_id }}">{{ $positiondata->sp_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-3 py-2">
                        <button type="submit" class="btn btn-primary  btn-sm"> <i class="bx bx-search fs-5 lh-0"></i> Search</button>
                    </div>
                </div>

                </form>
            </div>
        </div>

    ​
    ​   <hr class="my-3" />
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Staff List</h5>
    
        <div class="col-xl ">
            <div class="card ">
                <div class="card-header d-flex justify-content-between align-items-center">
              
                </div>
                <div class="card-body">
                
                        <div class="table-responsive text-nowrap ">
                            <table class="table" id="example">
                                <thead class="">
                                    <tr>
                                        <th>Sl.No</th>
                                        <th>NAME</th>
                                        <th>EMAIL</th>
                                        <th>JOIN DATE</th>
                                        <th>position</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    ​
                                    ​
                                    @foreach ($staffs as $staff)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $staff->sf_name }}</td>
                                            <td>{{ $staff->sf_email }}</td>
                                            <td>{{ $staff->sf_joindate }}</td>
                                            <td>{{ $staff->sp_name }}</td>
                                            {{-- <td>
                                  <form action="{{ route('students.destroy', $student->id) }}" method="POST">
​
                                    <a href="{{ route('students.show', $student->id) }}"
                                        class="btn btn-outline-info btn-sm"><i class="fa-solid fa-eye fa-lg"></i></a>
                                    <a href="{{ route('students.edit', $student->id) }}"
                                        class="btn btn-outline-warning btn-sm"><i
                                            class="fa-solid fa-file-pen fa-lg"></i></a>
                                    @method('DELETE')
                                    {{-- <a href="{{ route('students.destroy',$student->id) }}"  class="btn btn-outline-danger btn-sm"><i
                                    class="fa-solid fa-trash fa-lg "></i></a> --}}
                                            ​
                                            {{-- @csrf --}}
                                            ​
                                            ​
                                            {{-- <button type="submit" class="btn btn-outline-danger btn-sm"><i --}}
                                            {{-- class="fa-solid fa-trash fa-lg "></i></a></button> --}}
                                            {{-- </form> --}}
                                            {{-- </td>  --}}
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                      <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        @if (auth()->user()->type == 'admin')
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('staffs.show', $staff->staffsid) }}"><i
                                                                        class="fa-solid fa-eye"></i> View
                                                                    Profile</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('staffs.edit', $staff->staffsid) }}"><i
                                                                        class="fa-solid fa-pen"></i> Edit</a></li>
                                                            <li>
                                                                <form
                                                                    action="{{ route('staffs.destroy', $staff->staffsid) }}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        href="{{ route('staffs.destroy', $staff->staffsid) }}"class="dropdown-item"><i
                                                                            class="fa-solid fa-trash"></i> Delete</button>
                                                                    @csrf
                                                                    {{-- <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                                                class="fa-solid fa-trash "></i></button> --}}
                                                                </form>
                                                            </li>
                                                        @elseif (auth()->user()->type == 'clerk')
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('clerkstaffs.show', $staff->staffsid) }}"><i
                                                                        class="fa-solid fa-eye"></i> View
                                                                    Profile</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('clerkstaffs.edit', $staff->staffsid) }}"><i
                                                                        class="fa-solid fa-pen"></i> Edit</a></li>
                                                            <li>
                                                                <form
                                                                    action="{{ route('clerkstaffs.destroy', $staff->staffsid) }}"
                                                                    method="POST">
                                                                    
                                                                    
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        href="{{ route('clerkstaffs.destroy', $staff->staffsid) }}"class="dropdown-item"><i
                                                                            class="fa-solid fa-trash"></i> Delete</button>
                                                                    
                                                                    @csrf
                                                                    {{-- <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                                                    class="fa-solid fa-trash "></i></button> --}}
                                                                </form>
                                                            </li>
                                                        @else
                                                            return redirect()->route('home');
                                                        @endif



                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                     
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

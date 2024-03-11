@extends('layouts.studentapp')
@section('title', 'Home work')
@section('studentdashboard')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>

            </div>
            <div class="card-body">
                <form class="" action="{{ route('student.homeworkfilter') }}" method="get">
                    <div class="form-group row mb-1">
                        <label for="" class="col-sm-2 col-form-label">Previous Date</label>
                        <div class="col-md-5">
                            {{-- @if ($contentview)
                                <input type="hidden" name="sub_id" value="{{ $contentview->subid }}">
                            @else
                         
                            @endif --}}
                            {{-- <input type="text" id="automaticDate" name="automaticDate" pattern="\d{4}-\d{2}-\d{2}" placeholder="YYYY-MM-DD" required> --}}

                            <input type="date" name="olddate" id="" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary mt-2 btn-sm">Confirm <i
                                    class="fa-solid fa-location-arrow"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row py-2">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                {{-- 
                @if ($contentview)
                    <h4 class="mb-0">{{ $contentview->name }}</h4>
       
                @else
                    <h4 class="mb-0">No data</h4>
                @endif
    
                <small class="text-danger float-end">{{ $fyear }}</small> --}}
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-primary table-bordered table-striped ">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Subject</th>
                            <th>Title</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($homework as $homeworks)
                            <tr>
                                <td>
                                    {{ $homeworks->hw_date }}
                                </td>
                                <td>
                                    {{ $homeworks->name }}
                                </td>
                                <td>
                                    {{ $homeworks->hw_title }}
                                </td>
                                <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#content{{ $homeworks->id }}">
                                        <i class="fa-solid fa-eye" style="color:black"></i> view
                                    </a>
                                </td>
                            </tr>

                            {{-- Modal --}}
                            <div class="modal fade" id="content{{ $homeworks->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static"
                                data-bs-backdrop="static">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Content</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="{{ url($homeworks->hw_content_path) }}" type="application/pdf"
                                                width="100%" height="700px"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

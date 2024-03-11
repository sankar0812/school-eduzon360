@extends('layouts.studentapp')
@section('title', 'subjects')
@section('studentdashboard')
    <div class="row py-2">
        <div class="row">
            @foreach ($subject as $subjects)
                <div class="col-md-2">
                    <form action="{{ route('student.dailytopic') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="sub_id" value="{{ $subjects->subid }}">
                        <div class="card text-white bg-primary mb-3 h-100">
                            <button type="submit" class="btn btn-primary">
                                <div class="card-header text-center">
                                    {{ $subjects->name }}
                                </div>
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </button>
                        </div>
                    </form>

                </div>
            @endforeach
        </div>
    </div>
    </div>
@endsection

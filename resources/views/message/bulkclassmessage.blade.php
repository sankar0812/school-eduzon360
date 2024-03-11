@extends('layouts.default')
@section('title', 'Bulk Class Message')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <button type="button" class="btn btn-lg btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#parentmessage"><i
            class="fa-solid fa-pen"></i> compose</button>

    <div class="col-xl-12 p-2">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tabpanel" data-bs-toggle="tab"
                        data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="false"
                        style="font-weight:bold;">
                        Sent
                    </button>
                </li>
                {{-- <li class="nav-item">
                    <button type="button" class="nav-link " role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="true"
                        style="font-weight:bold;">
                        Inbox
                    </button>

                </li> --}}
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table" id="example5">
                                <thead class="">
                                    <tr>
                                        <th>TO class</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($bulkclass as $bulkclasss)
                                        <tr>
                                            <td>{{ $bulkclasss->c_class }}</td>
                                            <td>{{ $bulkclasss->bcm_subject }}</td>
                                            <td> {{ $bulkclasss->datetime }} </br>
                                            <td><a href="#" data-toggle="modal"
                                                    data-target="#exampleModal{{ $bulkclasss->id }}">
                                                    <i class="fa-solid fa-eye" style="color:black"></i>
                                                </a>
                                                @if (auth()->user()->type == 'admin')
                                                    <a href="{{ url('admin/bulkclassdelete', $bulkclasss->id) }}"
                                                        class="text-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                @elseif (auth()->user()->type == 'clerk')
                                                    <a href="{{ url('clerk/bulkclassdelete', $bulkclasss->id) }}"
                                                        class="text-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                @else
                                                    return redirect()->route('home');
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
    </div>
    {{-- message detail --}}
    <div class="modal fade" id="parentmessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">NEW MESSAGE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (auth()->user()->type == 'admin')
                        <form class="row g-3" action="{{ route('admin.bulkclassmessage') }}" method="POST"
                            enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'clerk')
                            <form class="row g-3" action="{{ route('clerk.bulkclassmessage') }}" method="POST"
                                enctype="multipart/form-data">
                            @else
                                return redirect()->route('home');
                    @endif


                    @csrf
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">TO</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="sender_admin" value="{{ Auth::user()->id }}">
                            <select class="form-select" name="receiver_class" required>
                                <option value="" selected disabled hidden>Select Class</option>
                                @foreach ($class as $classs)
                                    <option value="{{ $classs->id }}">
                                        {{ $classs->c_class }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label">Subject</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="" name="subject" placeholder="Subject"
                                required>

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-control">Message</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="form22" name="message" placeholder="Message" rows="3" required>


                               </textarea>
                            {{-- <input style="border:none;" type="file" name="attachment"
                                    > <i class="fa fa-paperclip" aria-hidden="true"  data-bs-backdrop="static"></i> --}}
                            {{-- <input type="file" name="attachment" accept="image/*" onchange="loadFile(event)">
                                <p><img id="output" width="200" /></p> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary">sent</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    @foreach ($bulkclass as $bulkclasss)
        <div class="modal fade" id="exampleModal{{ $bulkclasss->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">MESSAGE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ $bulkclasss->bcm_message }}
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('other-scripts')
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush

@extends('layouts.studentapp')
@section('title', 'inbox')
@section('studentsidebar')
    @include('include.studentsiderbar')
@endsection
@section('studentdashboard')
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
                <li class="nav-item">
                    <button type="button" class="nav-link " role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="true"
                        style="font-weight:bold;">
                        Inbox
                    </button>

                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped table-hover" id="example5">
                                <thead class="table-dark">
                                    <tr>
                                        <th>TO</th>
                                        <th>Subject</th>
                                        <th>Time and Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">

                                    @foreach ($senderMessagesStudent as $sendermessage)
                                        <tr>
                                            <td> {{ $sendermessage->name }}</td>
                                            <td> {{ $sendermessage->subject }}</td>
                                            <td>{{ $sendermessage->datetime }}</td>

                                            <td>{{ $sendermessage->datetime }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-profile" role="tab">
                    <div class="card-body row g-3">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped table-hover" id="example6">
                                <thead class="table-dark">

                                    <tr>
                                        <th>From</th>
                                        <th>Subject</th>
                                        <th>Time and Date</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($inboxMessagesStaff as $inboxmessage)
                                        <tr>
                                            <td>{{ $inboxmessage->name }}</td>
                                            <td>{{ $inboxmessage->subject }}</td>
                                            <td>{{ $inboxmessage->datetime }}</td>
                                            <!-- <td>{{ $inboxmessage->datetime }}</td> -->
                                        </tr>
                                    @endforeach
                                    @foreach ($inboxBulkMessages as $inboxBulkMessage)
                                        <tr>
                                            <td>{{ $inboxBulkMessage->name }}</td>
                                            <td>{{ $inboxBulkMessage->subject }}</td>
                                            <td>{{ $inboxBulkMessage->datetime }}</td>
                                            <!-- <td>{{ $inboxBulkMessage->datetime }}</td> -->
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
    <div class="modal fade" id="parentmessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">NEW MESSAGE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('studentmessage.add') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">TO</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="sender_student" value="{{ session('studentid') }}">
                                <select class="form-select" name="receiver_staff">
                                    <option value="none" selected disabled hidden>Select Staff</option>
                                    {{-- @foreach ($staffs as $staff)
                                        <option value="{{ $staff->login_id }}">
                                            {{ $staff->sf_name }}-{{ $staff->login_id }}
                                        </option>
                                    @endforeach --}}

                                    @foreach ($assignstaff as $assignstaffs)
                                        @foreach ($assignstaffs->view as $staff)
                                            <option value="{{ $staff->login_id }}">
                                                {{ $staff->sf_name }} ( {{ $staff->sf_subject_taken }} )
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-2 col-form-label">Subject</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="" name="subject"
                                    placeholder="Subject">

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-control">Message</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="form22" name="message" placeholder="Message" rows="3">


                               </textarea>
                                {{-- <input style="border:none;" type="file" name="attachment"
                                    > <i class="fa fa-paperclip" aria-hidden="true"></i> --}}
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


@endsection
@push('other-scripts')
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush

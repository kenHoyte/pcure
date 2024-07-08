@extends('backend.layouts.main')
@section('content')
<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
?>
<style>
    .hidden {
        display: none;
    }
    .upload-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .upload-card img {
        width: 100px;
        height: 100px;
    }
    .upload-buttons {
        display: flex;
        justify-content: space-between;
        width: 100%;
        margin-top: 10px;
    }
    .upload-buttons .btn {
        flex: 1;
        margin: 0 5px;
    }
    .modal-title {
        font-size: 18px;
    }
</style>
<!-- Preloader element -->
<div id="preloader" class="hidden">
    <div class="spinner"></div>
</div>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Uploads</h4>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                            {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                            {{session('error')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if ($errors->any())
                        <ul style="list-style: none">
                            @foreach ($errors->all() as $error)
                            <li>
                                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                    {{$error}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @endif

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Uploads</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="button-examples mb-2">
                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                    data-target="#uploadModal">Upload File</button>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($uploads as $upload)
                                <div class="col-sm-3">
                                    <div class="upload-card">
                                        @if ($upload->file_type == 'pdf')
                                        <img src="{{asset('assets/images/pdf.png')}}" alt="image" class="img-fluid" />
                                        @elseif($upload->file_type == 'csv')
                                        <img src="{{asset('assets/images/csv.png')}}" alt="image" class="img-fluid" />
                                        @elseif(in_array($upload->file_type, ['xls', 'xlsx']))
                                        <img src="{{asset('assets/images/xls.png')}}" alt="image" class="img-fluid" />
                                        @elseif(in_array($upload->file_type, ['doc', 'docx', 'txt']))
                                        <img src="{{asset('assets/images/doc.png')}}" alt="image" class="img-fluid" />
                                        @elseif(in_array($upload->file_type, ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ asset('uploads/' . $upload->file_path) }}" alt="image"
                                            class="img-fluid" />
                                        @endif

                                        <p class="mb-0 mt-2 text-center">
                                            <code>{{$upload->file_name}}</code>
                                        </p>

                                        <div class="upload-buttons">
                                            @if (in_array($upload->file_type, ['xls', 'xlsx', 'doc', 'docx']))
                                            <a href="{{ asset('uploads/' . $upload->file_path) }}" target="_blank"
                                                class="btn btn-primary btn-sm" style="display: none">
                                                Open
                                            </a>
                                            @else
                                            <a href="{{ asset('uploads/' . $upload->file_path) }}" target="_blank"
                                                class="btn btn-primary btn-sm">
                                                Open
                                            </a>
                                            @endif
                                            <a href="{{ asset('uploads/' . $upload->file_path) }}"
                                                download="{{ $upload->file_name }}" class="btn btn-secondary btn-sm">
                                                Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div>
                        {{$uploads->links()}}
                    </div>
                </div> <!-- end col -->

                <!-- sample modal content -->
                <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">File Upload</h5>
                                <button type="button" class="close waves-effect waves-light" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action={{route('uploadFile')}} enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="item">Title</label>
                                        <input type="text" id="title" name="title" class="form-control"
                                            placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="items">Attachment</label>
                                        <input type="file" id="attachment" name="attachment" class="form-control"
                                            placeholder="Enter your text">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Upload
                                            </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

</div>

<!-- JavaScript for handling payment and showing preloader -->
<script>
    document.getElementById('addBtn').addEventListener('click', function() {
        // Show preloader
        document.getElementById('spinnerBtn').classList.remove('hidden');
        document.getElementById('addBtn').classList.add('hidden');

        setTimeout(() => {
            document.getElementById('spinnerBtn').classList.add('hidden');
            document.getElementById('addBtn').classList.remove('hidden');
        }, 6000);
        
    });
</script>

<!-- App js -->
{{-- <script src="assets/js/app.js"></script> --}}

@endsection

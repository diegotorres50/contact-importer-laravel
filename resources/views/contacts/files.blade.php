@extends('layouts.app')
@section('content')
    <div class="card border-0">
        <div class="card-header">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <h2 class="my-2">Files imported</h2>
                </div>
                <div class="col-12 col-lg-6 col-xl-6">
                    <form method="post" action="{{route('contacts.import')}}" enctype="multipart/form-data"
                          id="importContactsForm">
                        @csrf
                        <input-file label="Chose file" id="importCSVFileContact" name="csvFile" btn-label="Upload"/>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped" style="table-layout: fixed">
                <thead>
                <tr>
                    <th class="border-top-0" scope="col" style="width: 35px">#</th>
                    <th class="border-top-0" scope="col" style="width: 180px">Name</th>
                    <th class="border-top-0" scope="col" style="width: 180px">Url</th>
                    <th class="border-top-0" scope="col" style="width: 180px">Path</th>
                    <th class="border-top-0" scope="col" style="width: 250px">Status</th>
                    <th class="border-top-0" scope="col" style="width: 180px">Created At</th>
                </tr>
                </thead>
                <tbody>
                @forelse($files as $file)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$file->name}}</td>
                        <td><a href="{{$file->url}}" download>{{$file->url}}</a></td>
                        <td>{{$file->path}}</td>
                        <td>{{$file->status}}</td>
                        <td>{{$file->created_at}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-secondary">No Records</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-end">
            {!! $files->links('vendor.pagination.bootstrap-4') !!}
        </div>
    </div>
@endsection

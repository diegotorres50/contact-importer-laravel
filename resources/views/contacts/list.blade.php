@extends('layouts.app')
@section('content')

    @if(isset($waiting))
        <div class="alert alert-info" role="alert">
            Importing contacts
        </div>
    @endif
    <div class="card border-0">
        <div class="card-header">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <h2 class="my-2">Contact List</h2>
                </div>
                <div class="col-12 col-lg-6 col-xl-6">
                    <form method="post" action="{{route('contacts.import')}}" enctype="multipart/form-data"
                          id="importContactsForm">
                        @csrf
                        <input-file label="Choose file" id="importCSVFileContact" name="csvFile" btn-label="Upload"/>
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
                    <th class="border-top-0" scope="col" style="width: 180px">Date of birth</th>
                    <th class="border-top-0" scope="col" style="width: 180px">Phone</th>
                    <th class="border-top-0" scope="col" style="width: 250px">Email</th>
                    <th class="border-top-0" scope="col" style="width: 180px">Credit Card</th>
                    <th class="border-top-0" scope="col" style="width: 150px">Franchise</th>
                    <th class="border-top-0" scope="col" style="width: 200px">Address</th>
                </tr>
                </thead>
                <tbody>
                @forelse($contacts as $contact)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$contact->name}}</td>
                        <td>{{$contact->dateOfBirth->format('F jS \\of Y')}}</td>
                        <td>{{$contact->phone}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->maskedCreditCard}}</td>
                        <td>{{$contact->franchise}}</td>
                        <td>{{$contact->address}}</td>
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
            {!! $contacts->links('vendor.pagination.bootstrap-4') !!}
        </div>
    </div>
@endsection

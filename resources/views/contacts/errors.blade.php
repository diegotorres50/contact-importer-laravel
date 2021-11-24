@extends('layouts.app')
@section('content')
    <div class="card border-0">
        <div class="card-header">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <h2 class="my-2">Exceptions List</h2>
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
                    <th class="border-top-0" scope="col" style="width: 200px">Exceptions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($exceptions as $exception)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$exception->name}}</td>
                        <td>{{$exception->date_of_birth ?? $exception->date_of_birth->format('F jS \\of Y')}}</td>
                        <td>{{$exception->phone}}</td>
                        <td>{{$exception->email}}</td>
                        <td>{{$exception->credit_card}}</td>
                        <td>{{$exception->franchise}}</td>
                        <td>{{$exception->address}}</td>
                        <td>
                            @foreach($exception->errors as $error)
                                <span class="badge badge-danger">
                                    {{$error}}
                                </span>
                            @endforeach
                        </td>
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
            {!! $exceptions->links('vendor.pagination.bootstrap-4') !!}
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <h2 class="my-2">Contact List</h2>
                </div>
                <div class="col-4 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#importContacts">Import</button>
                </div>
            </div>
        </div>
        <div class="card-body overflow-auto">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    {{--                    <th scope="col">Fecha de Nacimiento</th>--}}
                    <th scope="col">Teléfono</th>
                    <th scope="col">Email</th>
                    <th scope="col"></th>
                    {{--                    <th scope="col">Dirección</th>--}}
                    {{--                    <th scope="col">Tarjeta de Crédito</th>--}}
                    {{--                    <th scope="col">Franquicia</th>--}}
                </tr>
                </thead>
                <tbody>
                @forelse($contacts as $contact)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$contact->name}}</td>
                        <td>{{$contact->phone}}</td>
                        <td>{{$contact->email}}</td>
                        <td>
                            <a href="{{route('contacts.show', ['contact' => $contact->id])}}"
                            class="btn btn-primary">
                                Ver
                            </a>
                        </td>
                        {{--                        <td>{{$contact->dateOfBirth}}</td>--}}
                        {{--                        <td>{{$contact->address}}</td>--}}
                        {{--                        <td>{{$contact->creditCard}}</td>--}}
                        {{--                        <td>{{$contact->franchise}}</td>--}}
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

    <div class="modal" tabindex="-1" role="dialog" id="importContacts">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import from file csv</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="contacts/create" id="importContactsForm">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="importContactsForm">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

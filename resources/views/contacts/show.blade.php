@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col col-sm-6">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <h2 class="my-2">Contact Detail</h2>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ url()->previous()}}"
                               class="btn btn-secondary btn-sm d-inline-flex justify-content-center align-items-center">
                                <i class="material-icons">arrow_back</i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body overflow-auto">
                </div>
            </div>
        </div>
    </div>
@endsection

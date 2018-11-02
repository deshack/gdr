@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (session('status'))
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">{{$channel->name}}</div>

                    <div class="card-body">
                        <chat :channel="{{$channel->id}}" :user="{{Auth::user()->id}}"></chat>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

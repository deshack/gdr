@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                    <div class="card-header">Channels</div>

                    {{--<div class="card-body">--}}
                    <div class="list-group list-group-flush">
                        @foreach($channels as $channel)
                            <a href="{{route('chat.channels.show', ['channel' => $channel->id])}}"
                               class="list-group-item list-group-item-action">
                                {{$channel->name}}
                            </a>
                        @endforeach
                    </div>
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">List of Issues for {{ $repoData['name'] }}</div>
                    <div class="panel-body">
                        <div class="list-group">
                            @foreach($issueData as $data)
                                <div class="list-group-item">
                                    <a href="{{ $data['html_url'] }}">
                                        <h4>{{ $data['title'] }}</h4>
                                    </a>
                                    <p>{{ $data['body'] }}</p>
                                    @if ($data['comments'] == 1)
                                        <span class="label label-info">{{ $data['comments'] }} comment</span>
                                    @else
                                        <span class="label label-info">{{ $data['comments'] }} comments</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <a href="/repos">Back to list of repos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List of Repositories</div>
                <div class="panel-body">
                    <div class="list-group">
                        @foreach($repositoryData as $data)
                            <div class="list-group-item">
                                <a href="{{ $data['html_url'] }}">
                                    <h4>{{ $data['name'] }}</h4>
                                </a>
                                <p>{{ $data['description'] }}</p>
                                <a href="{{ $data['html_url'] }}/stargazers">
                                    <span class="label label-warning">{{ $data['stargazers_count'] }} stars</span>
                                </a>
                                @if ($data['open_issues'] > 0)
                                    <a href="/issues?uri={{ $data['url'] }}">
                                        <span class="label label-success">{{ $data['open_issues'] }} issues</span>
                                    </a>
                                @else
                                    <span class="label label-success">{{ $data['open_issues'] }} issues</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

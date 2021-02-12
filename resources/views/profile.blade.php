@extends('layouts.profile')
@section('content')

    <div class="ui link cards">
        <div class="card">
            <div class="image">
                <img src="assets/images/avatar/matthew.png">
            </div>
            <div class="content">
                <div class="header">{{ $user->surname }}</div>
                <div class="meta">
                    <a>{{ '@' . $user->username }}</a>
                </div>
                <div class="description">
                    {{ $user->biography }}
                </div>
            </div>
            <div class="extra content">
      <span class="right floated">
        Joined in {{ $user->created_at->format('Y') }}
      </span>
                <span>
        <i class="user icon"></i>
        75 Followers
      </span>
            </div>
        </div>
    </div>

@stop

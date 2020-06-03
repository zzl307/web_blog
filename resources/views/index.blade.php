@extends('layouts.home')
@section('content')
    <div class="home-box">
        <h2 title="{{ $site_title or 'title' }}" style="margin: 0;">
            {{ $site_title or __('web.MY_BLOG') }}
            <a aria-hidden="true" href="{{ route('post.index') }}">
                <img class="img-circle" src="{{ $avatar or 'https://raw.githubusercontent.com/lufficc/images/master/Xblog/logo.png' }}" alt="{{ $author or 'Author' }}">
            </a>
        </h2>
        <h3 title="{{ $description or 'description' }}" aria-hidden="true" style="margin: 0">
            {{ $description or 'Stay Hungry. Stay Foolish.' }}
        </h3>
        <p class="links">
            <span aria-hidden="true">»</span>
            <a href="{{ route('post.index') }}" aria-label="{{__('web.CLICK_SEE_LIST')}}">{{__('web.BLOG')}}</a>
            @foreach($pages as $page)
                <span aria-hidden="true">/</span>
                <a href="{{ route('page.show',$page->name) }}" aria-label="{{__('web.CHECK')}}{{ $author or 'author' }}{{__('web.`S')}}{{ $page->display_name }}">{{$page->display_name }}</a>
            @endforeach
        </p>
        <p class="links">
            <span aria-hidden="true">»</span>
            @foreach(['facebook','twitter','github','weibo','instagram','googleplus','tumblr','stackoverflow',
            'dribbble','linkedin','gitlab','pinterest','youtube'] as $social)
                @include('partials.social_icon', ['name' => $social])
            @endforeach
        </p>
    </div>
@endsection
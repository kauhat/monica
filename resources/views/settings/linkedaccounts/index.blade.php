@extends('layouts.skeleton')

@section('content')

<div class="settings">

  {{-- Breadcrumb --}}
  <div class="breadcrumb">
    <div class="{{ Auth::user()->getFluidLayout() }}">
      <div class="row">
        <div class="col-12">
          <ul class="horizontal">
            <li>
              <a href="{{ route('dashboard.index') }}">{{ trans('app.breadcrumb_dashboard') }}</a>
            </li>
            <li>
              <a href="{{ route('settings.index') }}">{{ trans('app.breadcrumb_settings') }}</a>
            </li>
            <li>
              {{ trans('app.breadcrumb_settings_users') }}
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="{{ Auth::user()->getFluidLayout() }}">
    <div class="row">

      @include('settings._sidebar')

      <div class="col-12 col-sm-9 users-list">

        <div class="mb3">
          <h3 class="f3 fw5">{{ trans('settings.linkedaccounts_title') }}</h3>
          <p>{{ trans('settings.linkedaccounts_description') }}</p>
        </div>

        <ul class="table br3 ba b--gray-monica bg-white mb4">
          <li class="table-row">
            <div class="table-cell">
              <i class="fa fa-google"></i>
            </div>

            <div class="table-cell">
              <h3>{{ trans('Google') }}</h3>
              <P>{{ trans('Link with Google to sync your contacts') }}</p>
            </div>

            <div class="table-cell tr">
              <a class="btn" href="{{ route('auth.thirdparty.redirect', ['provider' => 'google']) }}">Link account</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

@endsection

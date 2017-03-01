@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            User Profiles
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('backend.user_profiles.show_fields')
                    <a href="{!! route('backend.userProfiles.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection

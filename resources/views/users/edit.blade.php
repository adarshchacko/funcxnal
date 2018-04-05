@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <label class="col-form-label text-md-right">{{$user->name}}</label>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                        <div class="col-md-6">
                            <label class="col-form-label text-md-right">{{$user->email}}</label>
                        </div>
                    </div>                   


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
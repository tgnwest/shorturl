@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create new short url</div>

                    <div class="panel-body">

                        <form class="form-horizontal" method="POST" action="{{ route('create') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <div class="form-group{{ $errors->has('origin') ? ' has-error' : '' }}">
                                <label for="origin" class="col-md-4 control-label">Origin url *</label>

                                <div class="col-md-6">
                                    <input id="origin" type="text" class="form-control" name="origin" value="{{ old('origin') }}" required autofocus>

                                    @if ($errors->has('origin'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('origin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('short') ? ' has-error' : '' }}">
                                <label for="short" class="col-md-4 control-label">Desired short url</label>

                                <div class="col-md-6">
                                    <input id="short" type="text" class="form-control" name="short" value="{{ old('short') }}">

                                    @if ($errors->has('short'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('short') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create!
                                    </button>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

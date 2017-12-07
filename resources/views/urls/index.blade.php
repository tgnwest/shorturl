@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(Session::has('status'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{Session::get('status')}}
                    </div>
                @endif
                <a href="{{route('create')}}" class="btn btn-success">Add new url</a>
                <div class="panel panel-default">
                    <div class="panel-heading">My urls</div>

                    <div class="panel-body">

                        <table id="table1" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Full link</th>
                                <th>Short link</th>
                                <th>Count</th>
                                <th>Show on index page</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($urls as $url)
                                <tr>
                                    <td>{{$url->origin}}</td>
                                    <td>
                                        <a href="{{URL::to('/'.$url->short)}}">
                                            {{URL::to('/'.$url->short)}}
                                        </a>
                                    </td>
                                    <td>{{$url->count}}</td>
                                    <td>
                                        @if($url->isShared)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('share', $url->id)}}"><i class="fa fa-bullhorn fa-2x" aria-hidden="true"></i></a>
                                        <a href="{{route('delete', $url->id)}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#table1').DataTable();
        } );
    </script>
@endsection

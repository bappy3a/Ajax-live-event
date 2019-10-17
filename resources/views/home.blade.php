@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User List</div>

                <div class="card-body">
                    <div class="input-group flex-nowrap mb-3">
                      <input type="text" class="form-control" id="search" name="search"></input>
                    </div>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">QTY</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                            @if($users)
                                @foreach($users as $key=>$user)
                                    <tr>
                                      <th scope="row">{{ $key + 1 }}</th>
                                      <td>{{ $user->name }}</td>
                                      <td>{{ $user->email }}</td>
                                      <td>{{ $user->qty }}</td>
                                      <td><button class="btn btn-success btn-sm">+</button></td>
                                    </tr>
                                @endforeach
                            @endif
                      </tbody>
                    </table>
                      {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#search').on('keyup',function(){
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ URL::to('/search') }}',
            data: {
                'search': $value
            },
            success:function(data){
                $('tbody').html(data);
            }
        });
    })
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection

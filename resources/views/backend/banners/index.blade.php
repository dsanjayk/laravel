@extends('backend.layouts.master')

@section('content')

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Banners</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                        <li class="breadcrumb-item active">Banners List</li>
                    </ul>
                </div>            
               
            </div>
        </div>
        
        <div class="row clearfix">
            <div class="col-lg-12">
                @include('backend.layouts.notification')
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <a href="{{route('banner.create')}}" class="btn btn-primary" role="button" aria-haspopup="true" aria-expanded="false">Create Banner</a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Title</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        <th>Condition</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>                            
                                <tbody>
                                    @foreach($banners as $banner)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$banner->title}}</td>
                                        <td><img src="{{$banner->photo}}" alt="{{$banner->title}}" height="60" width="80"></td>
                                        <td><input name="toggle" value="{{$banner->status}}" data-banner-id="{{$banner->id}}"  type="checkbox" data-toggle="switchbutton" {{$banner->status=='active' ? 'checked' : ''}} data-onlabel="active" data-offlabel="inactive" data-onstyle="success" data-offstyle="danger"></td>
                                        <td>
                                            @if($banner->condition=='banner')
                                                <span class="badge badge-success">{{$banner->condition}}</span>
                                            @else
                                                <span class="badge badge-primary">{{$banner->condition}}</span>
                                            @endif    
                                        </td>
                                        <td>
                                            <a href="{{route('banner.edit',$banner->id )}}" data-toggle="edit" title="edit" class="btn btn-sm btn-outline-warning"><i class="fas fa-pencil-alt"></i></a> 
                                            <form action="{{route('banner.destroy',$banner->id )}}" method="post" style="display:inline;">
                                                @csrf
                                                @method('delete')
                                                <button  data-toggle="delete" title="delete" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </form>
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

    </div>
</div>

@endsection

@section('scripts')
<script>
    setTimeout(function(){ $('.alert').hide(); }, 4000);

    $('input[name=toggle]').change(function(){
        var id = $(this).data('banner-id');
        var mode = $(this).prop('checked');
        
        $.ajax({
            url : "{{route('banner.status')}}",
            type : 'POST',
            data:{
                _token : '{{csrf_token()}}',
                mode:mode,
                id:id,
            },
            success:function(response){
                if(response.status){
                    alert(response.msg);
                }
            }
        })
    });

</script>
@endsection
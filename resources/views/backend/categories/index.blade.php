@extends('backend.layouts.master')

@section('content')

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> categorys</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                        <li class="breadcrumb-item active">Categories List</li>
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
                        <a href="{{route('category.create')}}" class="btn btn-primary" role="button" aria-haspopup="true" aria-expanded="false">Create category</a>
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
                                        <th>Is Parent</th>
                                        <th>Parent</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>                            
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$category->title}}</td>
                                        <td><img src="{{$category->photo}}" alt="{{$category->title}}" height="60" width="80"></td>
                                        <td><input name="toggle" value="{{$category->status}}" data-category-id="{{$category->id}}"  type="checkbox" data-toggle="switchbutton" {{$category->status=='active' ? 'checked' : ''}} data-onlabel="active" data-offlabel="inactive" data-onstyle="success" data-offstyle="danger"></td>
                                        <td>
                                           {{$category->is_parent == 1 ? 'Yes' : 'No'}}   
                                        </td>
                                        <td>
                                            {{\App\Models\Category::where('id',$category->parent_id)->value('title')}}   
                                         </td>
                                        <td>
                                            <a href="{{route('category.edit',$category->id )}}" data-toggle="edit" title="edit" class="btn btn-sm btn-outline-warning"><i class="fas fa-pencil-alt"></i></a> 
                                            <form action="{{route('category.destroy',$category->id )}}" method="post" style="display:inline;">
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
        var id = $(this).data('category-id');
        var mode = $(this).prop('checked');
        
        $.ajax({
            url : "{{route('category.status')}}",
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
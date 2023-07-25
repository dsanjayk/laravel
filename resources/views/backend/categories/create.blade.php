@extends('backend.layouts.master')

@section('content')

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Add category</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('category.index')}}"><i class="icon-home"></i></a></li>                            
                        <li class="breadcrumb-item">categorys</li>
                        <li class="breadcrumb-item active">Add category</li>
                    </ul>
                </div>            
               
            </div>
        </div>
        
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">  
                    </div>
                    <form action="{{route('category.store')}}" method="post">
                        @csrf
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Title">Title</label>
                                        <input type="text" class="form-control" placeholder="Title" name="title" value="{{old('title')}}">
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Photo">Photo</label>
                                        <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="text" name="photo">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Is Parent">Is Parent</label>
                                        <input type="checkbox" id="is_parent" name="is_parent" value="1" checked>&nbsp; Yes
                                    </div>
                                </div>

                                
                                <div class="col-lg-6 col-md-6 col-sm-12 d-none" id="parent_cat_div">
                                    <div class="form-group">
                                    <label for="Is Parent">Parent Category</label>                                
                                    <select class="form-control show-tick" name="parent_id">
                                        
                                        <option value="" hidden>-- Parent Category --</option>
                                        @foreach( $parent_cats as $item )
                                         <option value="{{$item->id}}" {{old('parent_id') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Summary">Summary</label>
                                        <textarea class="form-control" placeholder="Summary" id="summary" name="summary">{{old('summary')}}</textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-6 col-sm-12">                                
                                    <select class="form-control show-tick" name="status">
                                        <option value="">-- Status --</option>
                                        <option value="active" {{old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{URL::previous()}}" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')

    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script>
        $('#lfm').filemanager('image');
    </script>
    <script>
        $(document).ready(function() {
            $('#summary').summernote();
        });

        $('#is_parent').on('change',function(e){
           e.preventDefault();
           let is_checked = $(this).prop('checked');
           if(is_checked){
                $('#parent_cat_div').addClass('d-none');
           }else{
            $('#parent_cat_div').removeClass('d-none');
           } 
        });
    </script>
@endsection
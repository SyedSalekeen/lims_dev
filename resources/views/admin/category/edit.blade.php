@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">

        @if (count($errors) > 0)
        <div class="alert round alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a class="btn btn-primary" href="{{ route('category.index') }}"> <i
                            class="ft-arrow-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">
                        <div class="form form-horizontal">
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Category modification</h4>
                                <hr>
                                {!! Form::model($category, ['method' => 'PATCH', 'route' => [ 'category.update', $category ],]) !!}
                                <div class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1"> Shop Name</label>
                                            <div class="col-md-9 mx-auto">
                                                <select class="form-control" name="shop_id">
                                                    <option selected disabled>Choose an option</option>
                                                    @foreach ( $shops as $shop )
                                                    <option value="{{ $shop->id }}" {{ $shop->id == $category->shop_id ? 'selected' : '' }} >{{ $shop->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="category">Category Name</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('name', null, ['placeholder' => 'Category Name', 'id' => 'category', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="description">Description</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('description', null, ['placeholder' => 'Description', 'id' => 'description', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" class="btn btn-success float-right box-shadow-1 mt-1 mb-1"><i
                                                class="ft-check"></i> Submit</button>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                <a href="{{ route('category.index') }}" type="submit"
                                                class="btn btn-primary float-right box-shadow-1 mt-1 mb-1 mr-1"><i
                                                class="ft-arrow-left"></i> back</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    @if (Session::get('success'))
    swal({
        title: "User modified",
        text: "User modified Successfully",
        icon: "success",
    });
    @endif
</script>
@endsection

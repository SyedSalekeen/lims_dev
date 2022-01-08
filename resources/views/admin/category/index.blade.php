@extends('admin.layouts.master')
@section('content')

<div class="row">
    <div class="col-12">
        @if ($message = Session::get('success'))
        <div class="alert my-2 alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Category Management</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li>
                            <a href="{{ route('category.create') }}" id="add_item" class="btn btn-success">
                                <i class="ft-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th> Sr #</th>
                                <th>Shop Name</th>
                                <th>Category Name</th>
                                <th>Description</th>
                                <th> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr role="row">
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->shop->name }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description ? $category->description : '-----' }}</td>
                                <td class="d-flex border-0">
                                    <a class="btn btn-primary box-shadow-1 btn-sm mr-1" href="{{ route('category.edit', $category) }}">
                                        <i class="ft-edit"></i>
                                    </a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['category.destroy', $category->id], 'style' => 'display:inline']) !!}
                                    {!! Form::submit('🗑', ['class' => 'btn btn-danger btn-sm box-shadow-1', 'onclick' => "return confirm('Are you sure you want to delete?');"]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $categories->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

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
                        <li><a class="btn btn-primary" href="{{ route('article.index') }}"> <i
                            class="ft-arrow-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">
                        <div class="form form-horizontal">
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Article modification</h4>
                                <hr>
                                {!! Form::model($article, ['method' => 'PATCH', 'route' => [ 'article.update', $article ], 'enctype' => 'multipart/form-data']) !!}
                                <div class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1"> Shop Name</label>
                                            <div class="col-md-9 mx-auto">
                                                <select class="form-control" name="shop_id">
                                                    <option selected disabled>Choose an option</option>
                                                    @foreach ( $shops as $shop )
                                                    <option value="{{ $shop->id }}" {{ $shop->id == $article->shop_id ? 'selected' : '' }} >{{ $shop->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="category_id"> Category Name</label>
                                            <div class="col-md-9 mx-auto">
                                                <select class="form-control" name="category_id" id="category_id">
                                                    @if($categories->count()>0)
                                                    <option selected disabled>Choose an option</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->id}}"{{ $category->id == $article->category_id ? 'selected' : '' }} >{{$category->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="reference">Reference</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('reference', null, ['placeholder' => 'Reference', 'id' => 'reference', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="description">Description</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('description', null, ['placeholder' => 'Description', 'id' => 'description', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="aBalance">Buying Price</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('buying_price', null, ['placeholder' => 'Buying Price', 'class' => 'form-control', 'id' => 'aBalance' ]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="aDiscount">For Discount</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('for_discount', null, [ 'placeholder' => 'For Discount', 'class' => 'form-control', 'id' => 'aDiscount' ]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="result">Discount</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('discount', null, [ 'placeholder' => 'Discount', 'class' => 'form-control', 'id' => 'result' ]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="atax">Percent VAT</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('percent_vat', null, [ 'placeholder' => 'Percent VAT', 'class' => 'form-control', 'id' => 'atax' ]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="taxresult">VAT</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('vat', null, [ 'placeholder' => 'VAT', 'class' => 'form-control', 'id' => 'taxresult' ]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="taxbuying">Purchase Price Include</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('purchase_price_include', null, [ 'placeholder' => 'Purchase Price Include', 'class' => 'form-control', 'id' => 'taxbuying' ]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="percent_margin">Percent Margin</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::number('percent_margin', null, [ 'placeholder' => 'Percent Margin', 'class' => 'form-control', 'id' => 'percent_margin' ]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="sale_price_ht">Sale Price HT</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::number('sale_price_ht', null, [ 'placeholder' => 'Sale Price HT', 'class' => 'form-control', 'id' => 'sale_price_ht' ]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="amount">Amount</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::number('amount', null, [ 'placeholder' => 'Amount', 'class' => 'form-control', 'id' => 'amount' ]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="stock_min">Stock min</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::number('stock_min', null, [ 'placeholder' => 'Stock min', 'class' => 'form-control', 'id' => 'stock_min' ]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="stock_max">Stock Max</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::number('stock_max', null, [ 'placeholder' => 'Stock Max', 'class' => 'form-control', 'id' => 'stock_max' ]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">Article Image</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="file" name="image" id="image" class="dropify" data-max-file-size="2M" data-default-file ="{{ asset( 'storage/article/'. $article->image ) }}"/>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" class="btn btn-success float-right box-shadow-1 mt-1 mb-1"><i
                                                class="ft-check"></i> Submit</button>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                <a href="{{ route('shop.index') }}" type="submit"
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

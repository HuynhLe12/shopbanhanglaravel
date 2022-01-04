@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Adding product
                        </header>
                        <div class="panel-body">
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product name</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="product name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product image</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" placeholder="product name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product price</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="product name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Discription</label>
                                    <TEXTAREA style="resize: none" row="8" class="form-control" name='product_desc' id="exampleInputPassword1" placeholder="Discription"></TEXTAREA> 
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Content</label>
                                    <TEXTAREA style="resize: none" row="8" class="form-control" name='product_content' id="exampleInputPassword1" placeholder="Discription"></TEXTAREA> 
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Category</label>
                                    <select class="form-control input-sm m-bot15" name="product_cate">
                                        @foreach($cate_product as $key => $cate)
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Brand</label>
                                    <select class="form-control input-sm m-bot15" name="product_brand">
                                        @foreach($brand_product as $key => $brand)
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Show</label>
                                    <select class="form-control input-sm m-bot15" name="product_status">
                                        <option value="1">Displayed</option>
                                        <option value="0">Not displayed </option>
                                    </select>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Submit</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
 @extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Adding brand
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
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand name</label>
                                    <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="brand name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Discription</label>
                                    <TEXTAREA style="resize: none" row="8" class="form-control" name='brand_product_desc' id="ck4" placeholder="Discription"></TEXTAREA> 
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Show</label>
                                    <select class="form-control input-sm m-bot15" name="brand_product_status">
                                        <option value="1">Displayed</option>
                                        <option value="0">Not displayed </option>
                                    </select>
                                </div>
                                <button type="submit" name="add_brand_product" class="btn btn-info">Submit</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
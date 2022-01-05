<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Brand;
use Session;
use Illuminate\Support\Facades\Redirect;
class BrandProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
     public function add_brand_product(){
        $this->AuthLogin();
    	return view('admin.add_brand_product');
    }

    public function all_brand_product(){
        $this->AuthLogin();
    	/*$all_brand_product = DB::table('tbl_brand')->get();*///without MODEL

        $all_brand_product = Brand::orderBy('brand_id','DESC')->get();
        //sort and use take() to limit limited number of brands 
        //use paginate() to Pagination

    	$manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
    	return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);
    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();

        /*---------------without MODEl-----------------*/
    	/*$data = array();
    	$data['brand_name'] = $request->brand_product_name;
    	$data['brand_desc'] = $request->brand_product_desc;
    	$data['brand_status'] = $request->brand_product_status;

    	DB::table('tbl_brand')->insert($data);*/
    	Session::put('message','insert successfully');
    	return Redirect::to('add-brand-product');
    }

    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
    	DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
    	Session::put('message','Not displayed successfully');
    	return Redirect::to('all-brand-product');
    }

    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
    	DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
    	Session::put('message','Displayed successfully');
    	return Redirect::to('all-brand-product');
    }

    public function edit_brand_product($brand_product_id) {
        $this->AuthLogin();
    	/*$edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();*/
        //using MODEL with Where()
        $edit_brand_product = Brand::where('brand_id',$brand_product_id)->get();

       /* $edit_brand_product = Brand::find($brand_product_id);*/

    	$manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
    	return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }

    public function update_brand_product(Request $request, $brand_product_id){
        $this->AuthLogin();
        /*----WITHOUT MODEL---------*/
    	/*$data = array();
    	$data['brand_name'] = $request->brand_product_name;
    	$data['brand_desc'] = $request->brand_product_desc;
    	DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);*/

        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->save();
    	Session::put('message','Update successfully!');
    	return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
    	DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
    	Session::put('message','Delete successfully!');
    	return Redirect::to('all-brand-product');
    }

    //end admin page

    public function show_brand_home($brand_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.brand_id',$brand_id)->get();
        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();
        return view('pages.Brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }
}

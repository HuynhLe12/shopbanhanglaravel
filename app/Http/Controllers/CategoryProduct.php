<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use App\Models\Brand;
use Session;
use Illuminate\Support\Facades\Redirect;
class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_category_product(){
    	return view('admin.add_category_product');
    }

    public function all_category_product(){
        $this->AuthLogin();
    	// $all_category_product = DB::table('tbl_category_product')->get();

        $all_category_product = Category::orderBy('category_id','DESC')->get();

    	$manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
    	return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request){
        $this->AuthLogin();

        $data = $request->all();
        $cate = new Category();
        $cate->category_name = $data['category_product_name'];
        $cate->category_desc = $data['category_product_desc'];
        $cate->category_status = $data['category_product_status'];
        $cate->meta_keywords = $data['category_product_keywords'];
        $cate->save();


    	/*$data = array();
    	$data['category_name'] = $request->category_product_name;
    	$data['category_desc'] = $request->category_product_desc;
        $data['meta_keywords'] = $request->category_product_keywords;
    	$data['category_status'] = $request->category_product_status;

    	DB::table('tbl_category_product')->insert($data);*/
    	Session::put('message','insert successfully');
    	return Redirect::to('add-category-product');
    }

    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
    	Category::where('category_id',$category_product_id)->update(['category_status'=>0]);
    	Session::put('message','Not displayed successfully');
    	return Redirect::to('all-category-product');
    }

    public function active_category_product($category_product_id){
    	Category::where('category_id',$category_product_id)->update(['category_status'=>1]);
    	Session::put('message','Displayed successfully');
    	return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id) {
        $this->AuthLogin();
    	$edit_category_product = Category::where('category_id',$category_product_id)->get();
    	$manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
    	return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }

    public function update_category_product(Request $request, $category_product_id){
        $this->AuthLogin();
        $data = $request->all();
        $cate = Category::find($category_product_id);
        $cate->category_name = $data['category_product_name'];
        $cate->category_desc = $data['category_product_desc'];
        $cate->meta_keywords = $data['category_product_keywords'];
        $cate->save();

    	/*$data = array();
    	$data['category_name'] = $request->category_product_name;
        $data['meta_keywords'] = $request->category_product_keywords;
    	$data['category_desc'] = $request->category_product_desc;
    	DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);*/
    	Session::put('message','Update successfully!');
    	return Redirect::to('all-category-product');
    }

    public function delete_category_product(Request $request, $category_product_id){
        $this->AuthLogin();
    	Category::where('category_id',$category_product_id)->delete();
    	Session::put('message','Delete successfully!');
    	return Redirect::to('all-category-product');
    }

    //end function admin page
    public function show_category_home(Request $request, $category_id){
        $cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('tbl_product.category_id',$category_id)->get();
        $category_name = Category::where('tbl_category_product.category_id',$category_id)->take(1)->get();
        foreach ($category_by_id as $key => $val) {
            $meta_desc = $val->category_desc;
            $meta_keywords = $val->meta_keywords;
            $meta_title = $val->category_name;
            $url_canonical = $request->url();
        }
        return view('pages.Category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }


}

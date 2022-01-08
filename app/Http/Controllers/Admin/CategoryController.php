<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Category;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.category.index')
            ->withCategories(Category::with('shop')->where('status','!=','0')->orderBy('id','DESC')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create')
        ->withShops(Shop::where('status','!=','0')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
        ]);

        try{
            $new_category = new Category();
            $new_category->shop_id = request()->shop_id;
            $new_category->name = request()->name;
            $new_category->description = request()->description;

            $new_category->save();

            return redirect()
                ->route('category.index')
                ->with('success','Category created successfully');
        }
        catch(\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit')
            ->withCategory($category)
            ->withShops(Shop::where('status','!=','0')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        try{
            $category->shop_id = request()->shop_id;
            $category->name = request()->name;
            $category->description = request()->description;

            $category->save();
            return redirect()
            ->route('category.index')
            ->with('success','Category Updated successfully');
        }
        catch(\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            $category->delete();
            return redirect()
                ->route('category.index')
                ->with('success','Category deleted successfully');
        } catch(\Exception $e) {
            return redirect()
                ->back()
                ->with('error',$e->getMessage());
        }
    }
}

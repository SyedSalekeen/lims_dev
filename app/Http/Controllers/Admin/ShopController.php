<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:shop-list|shop-create|shop-edit|shop-delete', ['only' => ['index','show']]);
        $this->middleware('permission:shop-create', ['only' => ['create','store']]);
        $this->middleware('permission:shop-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:shop-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $shop = Shop::where('status','1')->orderBy('id','DESC')->paginate(5);
        // dd($shop);
        return view ('admin.shop.index',compact('shop'))
        ->with('i', ($request->input('page', 1) - 1) * 5);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.shop.create',compact('roles'));
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
            'name' => 'nullable|unique:shops',
        ]);

        $shop_insert = $request->all();
       $shop = Shop::create($shop_insert);
       return redirect()->route('shop.index')
       ->with('success','Shop created successfully');
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
    public function edit($id)
    {
        //
        $shop = Shop::find($id);
        // $roles = Role::pluck('name','name')->all();
        // $userRole = $user->roles->pluck('name','name')->all();

        return view('admin.shop.edit',compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $shop = Shop::find($id);
        $shop->update($input);
        return redirect()->route('shop.index')
        ->with('success','Shop updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::find($id);
        $shop->status = "0";
        $shop->save();
        return redirect()->route('shop.index')
                        ->with('success','Shop deleted successfully');
        //
    }
}

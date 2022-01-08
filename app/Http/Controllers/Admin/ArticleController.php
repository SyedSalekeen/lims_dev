<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Shop;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.article.index')
            ->withArticles(Article::with('shop')->where('status','!=','0')
            ->orderBy('id','DESC')
            ->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create')
            ->withShops(Shop::where('status','!=','0')
            ->get())
            ->withcategories(Category::where('status','!=','0')
            ->get());
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
            'shop_id' => 'required',
            'category_id' => 'required',
            'reference' => 'required',
            'buying_price' => 'required',
            'for_discount' => 'required',
            'discount' => 'required',
            'percent_vat' => 'required',
            'vat' => 'required',
            'purchase_price_include' => 'required',
            'percent_margin' => 'required',
            'sale_price_ht' => 'required',
            'amount' => 'required',
            'stock_min' => 'required',
            'stock_max' => 'required',
        ]);

        try {
            $new_article = new Article();
            $new_article->shop_id = request()->shop_id;
            $new_article->category_id = request()->category_id;
            $new_article->reference = request()->reference;
            $new_article->description = request()->description;
            $new_article->buying_price = request()->buying_price;
            $new_article->for_discount = request()->for_discount;
            $new_article->discount = request()->discount;
            $new_article->percent_vat = request()->percent_vat;
            $new_article->vat = request()->vat;
            $new_article->purchase_price_include = request()->purchase_price_include;
            $new_article->percent_margin = request()->percent_margin;
            $new_article->sale_price_ht = request()->sale_price_ht;
            $new_article->amount = request()->amount;
            $new_article->stock_min = request()->stock_min;
            $new_article->stock_max = request()->stock_max;
            if(request()->has('image')) {
                $new_article->image = basename(request()->file('image')->store('public/article'));
            }
            $new_article->save();

            return redirect()
                ->route('article.index')
                ->with('success','Article created successfully');
        } catch(\Exception $e) {
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
    public function edit(Article $article)
    {
        return view('admin.article.edit')
            ->withArticle($article)
            ->withShops(Shop::where('status','!=','0')->get())
            ->withcategories(Category::where('status','!=','0')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'shop_id' => 'required',
            'category_id' => 'required',
            'reference' => 'required',
            'buying_price' => 'required',
            'for_discount' => 'required',
            'discount' => 'required',
            'percent_vat' => 'required',
            'vat' => 'required',
            'purchase_price_include' => 'required',
            'percent_margin' => 'required',
            'sale_price_ht' => 'required',
            'amount' => 'required',
            'stock_min' => 'required',
            'stock_max' => 'required',
        ]);

        try {
            $article->shop_id = request()->shop_id;
            $article->category_id = request()->category_id;
            $article->reference = request()->reference;
            $article->description = request()->description;
            $article->buying_price = request()->buying_price;
            $article->for_discount = request()->for_discount;
            $article->discount = request()->discount;
            $article->percent_vat = request()->percent_vat;
            $article->vat = request()->vat;
            $article->purchase_price_include = request()->purchase_price_include;
            $article->percent_margin = request()->percent_margin;
            $article->sale_price_ht = request()->sale_price_ht;
            $article->amount = request()->amount;
            $article->stock_min = request()->stock_min;
            $article->stock_max = request()->stock_max;
            if(request()->has('image')) {
                Storage::delete( 'public/article/'. $article->image );
                $article->image = basename(request()->file('image')->store('public/article'));
            }
            $article->save();

            return redirect()
                ->route('article.index')
                ->with('success','Article updated successfully');
        } catch(\Exception $e) {
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
            $article = Article::find($id);
            $article->delete();
            return redirect()
                ->route('article.index')
                ->with('success','Article deleted successfully');
        } catch(\Exception $e) {
            return redirect()
                ->back()
                ->with('error',$e->getMessage());
        }
    }
}

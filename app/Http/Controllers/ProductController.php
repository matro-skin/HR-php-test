<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View | \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $products = Product::orderBy('name')->paginate();

        $view = view('products.index', compact('products'));

	    if( $request->ajax() ) {
		    return response([
			    'data' => $view->renderSections()['content'],
		    ]);
	    }

        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response | \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {

//    	dd( $request->validated() );

	    try {
		    $product->update( $request->validated() );
	    }
	    catch (\Exception $e) {
		    report($e);
		    if( $request->ajax() ) {
		    	abort(400, __('Данные товара не обновлены'));
		    }
		    return redirect()->back()
		                     ->withInput()
		                     ->withErrors([ __('Данные товара не обновлены') ]);
	    }

	    if( $request->ajax() ) {
	    	return response([
	    		'message' => __('Данные товара обновлены'),
		    ]);
	    }

	    return redirect()->back()
	                     ->with('success', __('Данные товара обновлены'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

}

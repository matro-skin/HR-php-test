<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Order;
use App\Partner;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View | \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    	$tab = $request->tab;

	    $orders = Order::when( in_array($tab, [ 'active', 'created', 'completed' ]), function (Builder $query) use ($tab) {

	    	return $this->getOrderScope($query, $tab);

	    }, function (Builder $query) {

		    return $query->expired()
		                 ->orderByDesc('delivery_dt') // сортировка по дате доставки по убыванию
		                 ->limit(50) // ограничение 50 штук
		                 ->get()
		                 ->paginate(50); // используем пагинацию коллекции

	    });

	    $view = view('orders.index', compact('orders','tab'));

	    if( $request->ajax() ) {
		    return response([
		    	'data' => $view->renderSections()['content'],
		    ]);
	    }

        return $view;

    }

	/**
	 * Get scope of orders by tab
	 *
	 * @param Builder $query
	 * @param string $tab
	 *
	 * @return Builder $query
	 */
	protected function getOrderScope(Builder $query, $tab)
    {

	    switch ($tab) {

		    case 'active' :
			    return $query->active()
			                 ->orderBy('delivery_dt') // сортировка по дате доставки по возрастанию
			                 ->paginate();

		    case 'created' :
			    return $query->created()
			                 ->orderBy('delivery_dt') // сортировка по дате доставки по возрастанию
			                 ->limit(50) // ограничение 50
				    ->get()
				    ->paginate(50); // используем пагинацию коллекции

		    case 'completed' :
			    return $query->completed()
			                 ->orderByDesc('delivery_dt') // сортировка по дате доставки по убыванию
			                 ->limit(50) // ограничение 50
			                 ->get()
			                 ->paginate(50); // используем пагинацию коллекции

	    }

	    return $query;

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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\View\View
     */
    public function edit(Order $order)
    {
    	$partners = Partner::orderBy('name')->get();
    	return view('orders.edit', compact('order','partners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OrderRequest $request, Order $order)
    {

        try {
	        $order->update( $request->validated() );
        }
        catch (\Exception $e) {
        	report($e);
	        return redirect()->back()
	                         ->withInput()
	                         ->withErrors([ __('Данные заказа не обновлены') ]);
        }

        return redirect()->back()
                         ->with('success', __('Данные заказа обновлены'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

}

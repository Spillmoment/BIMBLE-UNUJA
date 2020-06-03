<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;


class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:manager');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Order::with(['pendaftar', 'order_detail'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('admin.order.index', [
            'items' => $items
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Order::with([
            'pendaftar', 'order_detail'
        ])->findOrFail($id);

        $check = OrderDetail::with('pendaftar', 'order', 'kursus')
            ->where('id_order', $items->id) // hasMany to Order
            ->get();

        return view('admin.order.show', [
            'item' => $items,
            'detail' => $check,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.edit', [
            'order' => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        $data = $request->all();

        $item = Order::findOrFail($id);

        $item->update($data);

        return redirect()->route('order.index')
            ->with(['status', 'Data Order Berhasil Di Update!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Order::findOrFail($id);
        $item->forceDelete();
        return redirect()->route('order.index')
            ->with(['status', 'Data Order Berhasil Di Hapus!']);
    }

    public function setStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:PENDING,SUCCESS,FAILED'
        ]);

        $item = Order::findOrFail($id);
        $item->status_kursus = $request->status;

        $item->save();

        return redirect()->route('order.index');
    }
}

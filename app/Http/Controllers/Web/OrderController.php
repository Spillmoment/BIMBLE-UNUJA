<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orderPost(Request $request)
    {   
        $this->validate($request, [
            'id_pendaftar' => 'required|integer',
            'id_kursus' => 'required|integer',
            'biaya_kursus' => 'required|integer',
            'diskon_kursus' => 'required|integer',
        ]);
        $pendaftarId = Auth::id();
        $harga_kursus = $request->biaya_kursus;
        $diskon_kursus = $request->diskon_kursus;
        $diskon = $harga_kursus * ($diskon_kursus/100);

        $check_order = Order::where('id_pendaftar', $pendaftarId)
                        ->where('status_kursus', 'PROCESS')
                        ->count();
        if ($check_order == 0) {
            $order = Order::create([
                'id_pendaftar' => $pendaftarId,
                'total_tagihan' => $request->biaya_kursus - $diskon,
                'status_kursus' => 'PROCESS',    
            ]);
            $orderId = $order->id;
        } else {
            $orderId = Order::where('id_pendaftar', $pendaftarId)
                        ->where('status_kursus', 'PROCESS')
                        ->first()
                        ->id;
            Order::where('id', $orderId)->increment('total_tagihan', $request->biaya_kursus - $diskon);
        }

        OrderDetail::create([
            'id_order' => $orderId,
            'id_pendaftar' => $request->id_pendaftar,
            'id_kursus' => $request->id_kursus,
            'biaya_kursus' => $request->biaya_kursus - $diskon,
            'status' => 'PROCESS',
        ]);

        // $order_detail = new OrderDetail();
        // $order_detail->id_order = $orderId;
        // $order_detail->id_pendaftar = $request->id_pendaftar;
        // $order_detail->id_kursus = $request->id_kursus;
        // $order_detail->biaya_kursus = $request->biaya_kursus - $diskon;
        // $order_detail->status = 'PROCESS';
        // $order_detail->save();

        return redirect()->back();
    }

    public function view()
    {
        $pendaftarId = Auth::id();
        $order_kursus = OrderDetail::with(['pendaftar', 'kursus'])
                        ->where('id_pendaftar', $pendaftarId)
                        ->where('status', 'PROCESS')
                        ->orderBy('created_at', 'ASC')
                        ->get();
        
        $total_tagihan = OrderDetail::where('id_pendaftar', $pendaftarId)
                            ->where('status', 'PROCESS')
                            ->sum('biaya_kursus');
        return view('web.web_order_cart', compact('order_kursus', 'total_tagihan'));
    }

    public function updateToPending(Request $request)
    {
        // dd($r);
        $order = OrderDetail::findOrFail($request->order_id);
        $order->status = $request->status;
        $order->save();
        // hitung total harga
        $tot_tagihan = OrderDetail::where('id_pendaftar', $request->id_pendaftar)
                            ->where('status', 'PROCESS')
                            ->sum('biaya_kursus');
        
        Order::find($request->order_fk)->update(['total_tagihan' => $tot_tagihan]);

        return response()->json([
            'message' => 'Bimbel '.$request->nama_kursus.' berhasil di update status.',
            'totalTagihan' => $tot_tagihan
            ]);
    }

    // public function updateToDelete(Request $request)
    // {
    //     $order_detail = OrderDetail::find($request->id);
    //     $order_detail->forceDelete();

    //     $tot_tagihan = Order::where('id', $request->id_order)
    //                         ->where('status', 'PROCESS')
    //                         ->first()
    //                         ->biaya_kursus;

    //     Order::where('id', 8)->update(['total_tagihan' => $tot_tagihan]);

    //     return response()->json([
    //         'message' => 'Bimbel berhasil di cancel.',
    //         'totalTagihan' => $tot_tagihan
    //         ]);
    // }

    public function updateToDelete($id){
        
        $order_detail = OrderDetail::findOrFail($id);
        $order_detail->forceDelete();

        $order = Order::find($order_detail->id_order);
        // $decrement = $order->total_tagihan - $order_detail->biaya_kursus;
        $tot_tagihan = OrderDetail::where('id_pendaftar', $order_detail->id_pendaftar)
                            ->where('status', 'PROCESS')
                            ->sum('biaya_kursus');
        $order->update(['total_tagihan' => $tot_tagihan]);

        return response()->json([
            'message' => 'Bimbel berhasil di cancel.',
            'totalTagihan' => $order->total_tagihan
        ]);
    }
}

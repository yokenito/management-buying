<?php

namespace App\Http\Controllers;

use App\Models\Receivedetail;
use App\Models\Rceive;
use Illuminate\Http\Request;

class ReceivedetalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Rceive $receive)
    {
        return view('receivedetails.create', compact('receive'));
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
            'product_id' => 'required',
            'product_count' => 'required',
            'product_price' => 'required',
        ]);

        $receivedetail = new Receivedetail();
        $receivedetail->receive_id = $request->input('receive_id');
        $receivedetail->product_id = $request->input('product_id');
        $receivedetail->product_count = $request->input('product_count');
        $receivedetail->price = $request->input('product_price');
        $receivedetail->sum_price = $request->input('product_count') * $request->input('product_price');
        $receivedetail->save();

        // 明細の合計を見積に保存
        $receive = Rceive::where('id',$request->input('receive_id'))->first();
        $calc_sum = Receivedetail::where('receive_id',$request->input('receive_id'))->get();
        $sum_price = 0;
        foreach($calc_sum as $calc_price){
            $sum_price += $calc_price->sum_price;
        }
        $receive->sum_price = $sum_price;
        $receive->save();

        return redirect()->route('receives.show', ['receive' => $request->input('receive_id')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receivedetail  $receivedetail
     * @return \Illuminate\Http\Response
     */
    public function show(Receivedetail $receivedetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receivedetail  $receivedetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Receivedetail $receivedetail)
    {
        return view('receivedetails.edit', compact('receivedetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receivedetail  $receivedetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receivedetail $receivedetail)
    {
        $request->validate([
            'product_id' => 'required',
            'product_count' => 'required',
            'product_price' => 'required',
        ]);

        $receivedetail->receive_id = $request->input('receive_id');
        $receivedetail->product_id = $request->input('product_id');
        $receivedetail->product_count = $request->input('product_count');
        $receivedetail->price = $request->input('product_price');
        $receivedetail->sum_price = $request->input('product_count') * $request->input('product_price');
        $receivedetail->save();

        // 明細の合計を見積に保存
        $receive = Rceive::where('id',$request->input('receive_id'))->first();
        $calc_sum = Receivedetail::where('receive_id',$request->input('receive_id'))->get();
        $sum_price = 0;
        foreach($calc_sum as $calc_price){
            $sum_price += $calc_price->sum_price;
        }
        $receive->sum_price = $sum_price;
        $receive->save();

        return redirect()->route('receives.show', ['receive' => $request->input('receive_id')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receivedetail  $receivedetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receivedetail $receivedetail)
    {
        $receive_id = $receivedetail->receive_id;
        $receivedetail->delete();

        // 明細の合計を見積に保存
        $receive = Rceive::where('id',$receive_id)->first();
        $calc_sum = Receivedetail::where('receive_id',$receive_id)->get();
        $sum_price = 0;
        foreach($calc_sum as $calc_price){
            $sum_price += $calc_price->sum_price;
        }
        $receive->sum_price = $sum_price;
        $receive->save();

        return redirect()->route('receives.show', ['receive' => $receive_id]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Estimatedetail;
use App\Models\Estimate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstimatedetalController extends Controller
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
    public function create(Estimate $estimate)
    {
        return view('estimatedetails.create', compact('estimate'));
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

        $estimatedetail = new Estimatedetail();
        $estimatedetail->estimate_id = $request->input('estimate_id');
        $estimatedetail->product_id = $request->input('product_id');
        $estimatedetail->product_count = $request->input('product_count');
        $estimatedetail->price = $request->input('product_price');
        $estimatedetail->sum_price = $request->input('product_count') * $request->input('product_price');
        $estimatedetail->save();

        // 明細の合計を見積に保存
        $estimate = Estimate::where('id',$request->input('estimate_id'))->first();
        $calc_sum = Estimatedetail::where('estimate_id',$request->input('estimate_id'))->get();
        $sum_price = 0;
        foreach($calc_sum as $calc_price){
            $sum_price += $calc_price->sum_price;
        }
        $estimate->sum_price = $sum_price;
        $estimate->save();

        return redirect()->route('estimates.show', ['estimate' => $request->input('estimate_id')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estimatedetail  $estimatedetail
     * @return \Illuminate\Http\Response
     */
    public function show(Estimatedetail $estimatedetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estimatedetail  $estimatedetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Estimatedetail $estimatedetail)
    {
        return view('estimatedetails.edit', compact('estimatedetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estimatedetail  $estimatedetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estimatedetail $estimatedetail)
    {
        $request->validate([
            'product_id' => 'required',
            'product_count' => 'required',
            'product_price' => 'required',
        ]);

        $estimatedetail->estimate_id = $request->input('estimate_id');
        $estimatedetail->product_id = $request->input('product_id');
        $estimatedetail->product_count = $request->input('product_count');
        $estimatedetail->price = $request->input('product_price');
        $estimatedetail->sum_price = $request->input('product_count') * $request->input('product_price');
        $estimatedetail->save();

        // 明細の合計を見積に保存
        $estimate = Estimate::where('id',$request->input('estimate_id'))->first();
        $calc_sum = Estimatedetail::where('estimate_id',$request->input('estimate_id'))->get();
        $sum_price = 0;
        foreach($calc_sum as $calc_price){
            $sum_price += $calc_price->sum_price;
        }
        $estimate->sum_price = $sum_price;
        $estimate->save();

        return redirect()->route('estimates.show', ['estimate' => $request->input('estimate_id')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estimatedetail  $estimatedetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estimatedetail $estimatedetail)
    {
        $estimate_id = $estimatedetail->estimate_id;
        $estimatedetail->delete();

        // 明細の合計を見積に保存
        $estimate = Estimate::where('id',$estimate_id)->first();
        $calc_sum = Estimatedetail::where('estimate_id',$estimate_id)->get();
        $sum_price = 0;
        foreach($calc_sum as $calc_price){
            $sum_price += $calc_price->sum_price;
        }
        $estimate->sum_price = $sum_price;
        $estimate->save();

        return redirect()->route('estimates.show', ['estimate' => $estimate_id]);
    }
}

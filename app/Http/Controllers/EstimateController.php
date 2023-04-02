<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\Models\Estimatedetail;
use App\Models\Fixvalue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estimates = Estimate::orderBy('issue_date','desc')->paginate(5);
        return view('estimates.index', compact('estimates'));
    }
    public function searchindex(Request $request)
    {
        if($request->issue_date_start != null && $request->issue_date_end != null){
            $estimates = Estimate::whereBetween('issue_date', [$request->issue_date_start, $request->issue_date_end])
                ->where('subject','like', '%'.$request->subject.'%');
        }elseif($request->issue_date_start != null && $request->issue_date_end == null){
            $estimates = Estimate::where('issue_date', '>', $request->issue_date_start)
                ->where('subject','like', '%'.$request->subject.'%');
        }elseif($request->issue_date_start == null && $request->issue_date_end != null){
            $estimates = Estimate::where('issue_date', '<', $request->issue_date_end)
                ->where('subject','like', '%'.$request->subject.'%');
        }else{
            $estimates = Estimate::where('subject','like', '%'.$request->subject.'%');
        }

        if($request->client != null){
            $estimates = $estimates->where('client_id','=', $request->client);
        }

        if($request->person != null){
            $estimates = $estimates->where('person_id','=', $request->person);
        }

        if($request->status == 2){
            $estimates = $estimates->where('status','=', $request->status)->orWhere('status','=', '4');
        } elseif($request->status != null){
            $estimates = $estimates->where('status','=', $request->status);
        }

        
        $estimates = $estimates->orderBy('issue_date','desc')->paginate(5);
        return view('estimates.searchindex', compact('estimates', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estimates.create');
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
            'estimate_no'=> 'required',
            'subject'=>'required',
            'issue_date'=> 'required',
            'person_id'=>'required',
            'client_id'=> 'required',
            'delivery_line'=>'required',
            'date_line'=> 'required',
            'expire_date'=> 'required',
            'issue_date'=> 'required',
            'pay_requirement'=>'required',
        ]);

        $estimate = new Estimate();
        $estimate->estimate_no = $request->input('estimate_no');
        $estimate->client_id = $request->input('client_id');
        $estimate->subject = $request->input('subject');
        $estimate->issue_date = $request->input('issue_date');
        $estimate->person_id = $request->input('person_id');
        $estimate->client_id = $request->input('client_id');
        $estimate->delivery_line = $request->input('delivery_line');
        $estimate->date_line = $request->input('date_line');
        $estimate->expire_date = $request->input('expire_date');
        $estimate->delivery_place = $request->input('delivery_place');
        $estimate->pay_requirement = $request->input('pay_requirement');
        $estimate->estimate_requirement = $request->input('estimate_requirement');
        $estimate->note = $request->input('note');
        $estimate->save();

        return redirect()->route('estimates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function show(Estimate $estimate)
    {
        $companyinf = [
            'name' => Fixvalue::where('id',1)->value('fixvalue'),
            'post' => Fixvalue::where('id',2)->value('fixvalue'),
            'address' => Fixvalue::where('id',3)->value('fixvalue'),
            'phone' => Fixvalue::where('id',4)->value('fixvalue'),
        ];

        $estimatedetails = Estimatedetail::where('estimate_id',$estimate->id)->get();
        $estimatedetails_count = $estimatedetails->count();

        return view('estimates.show', compact('estimate','companyinf','estimatedetails','estimatedetails_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function edit(Estimate $estimate)
    {
        return view('estimates.edit', compact('estimate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estimate $estimate)
    {
        $request->validate([
            'estimate_no'=> 'required',
            'subject'=>'required',
            'issue_date'=> 'required',
            'person_id'=>'required',
            'client_id'=> 'required',
            'delivery_line'=>'required',
            'date_line'=> 'required',
            'expire_date'=> 'required',
            'pay_requirement'=>'required',
        ]);

        $estimate->estimate_no = $request->input('estimate_no');
        $estimate->client_id = $request->input('client_id');
        $estimate->subject = $request->input('subject');
        $estimate->issue_date = $request->input('issue_date');
        $estimate->person_id = $request->input('person_id');
        $estimate->client_id = $request->input('client_id');
        $estimate->delivery_line = $request->input('delivery_line');
        $estimate->date_line = $request->input('date_line');
        $estimate->expire_date = $request->input('expire_date');
        $estimate->delivery_place = $request->input('delivery_place');
        $estimate->pay_requirement = $request->input('pay_requirement');
        $estimate->estimate_requirement = $request->input('estimate_requirement');
        $estimate->note = $request->input('note');
        $estimate->save();

        return redirect()->route('estimates.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estimate $estimate)
    {
        $estimate->delete();
        return redirect()->route('estimates.index');
    }

    public function confirm(Estimate $estimate)
    {
        $estimate->status = 1;
        $estimate->save();

        return redirect()->route('estimates.show', ['estimate' => $estimate->id]);
    }
    public function receive(Estimate $estimate)
    {
        $estimate->status = 2;
        $estimate->expire_date = null;
        $estimate->save();

        return redirect()->route('estimates.show', ['estimate' => $estimate->id]);
    }

    public function copy(Estimate $estimate)
    {
        return view('estimates.copy', compact('estimate'));
    }

    public function copycreate(Request $request)
    {
        $request->validate([
            'estimate_no'=> 'required',
            'subject'=>'required',
            'issue_date'=> 'required',
            'person_id'=>'required',
            'client_id'=> 'required',
            'delivery_line'=>'required',
            'date_line'=> 'required',
            'expire_date'=> 'required',
            'pay_requirement'=>'required',
        ]);

        $estimate = new Estimate();
        $estimate->estimate_no = $request->input('estimate_no');
        $estimate->client_id = $request->input('client_id');
        $estimate->subject = $request->input('subject');
        $estimate->issue_date = $request->input('issue_date');
        $estimate->person_id = $request->input('person_id');
        $estimate->client_id = $request->input('client_id');
        $estimate->delivery_line = $request->input('delivery_line');
        $estimate->date_line = $request->input('date_line');
        $estimate->expire_date = $request->input('expire_date');
        $estimate->delivery_place = $request->input('delivery_place');
        $estimate->pay_requirement = $request->input('pay_requirement');
        $estimate->estimate_requirement = $request->input('estimate_requirement');
        $estimate->note = $request->input('note');
        $estimate->sum_price = $request->input('sum_price');
        $estimate->save();

        // 明細の保存
        $details = Estimatedetail::where('estimate_id',$request->input('estimate_id'))->get();
        foreach($details as $detail){
            $estimatedetail = new Estimatedetail();
            $estimatedetail->estimate_id = $estimate->id;
            $estimatedetail->product_id = $detail->product_id;
            $estimatedetail->product_count = $detail->product_count;
            $estimatedetail->price = $detail->price;
            $estimatedetail->sum_price = $detail->sum_price;
            $estimatedetail->save();
        }

        return redirect()->route('estimates.index');
    }
}

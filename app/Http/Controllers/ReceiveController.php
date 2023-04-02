<?php

namespace App\Http\Controllers;

use App\Models\Rceive;
use App\Models\Receivedetail;
use App\Models\Estimate;
use App\Models\Estimatedetail;
use App\Models\Fixvalue;
use Illuminate\Http\Request;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receives = Rceive::orderBy('issue_date','desc')->paginate(5);
        return view('receives.index', compact('receives'));
    }

    public function searchindex(Request $request)
    {
        if($request->issue_date_start != null && $request->issue_date_end != null){
            $receives = Rceive::whereBetween('issue_date', [$request->issue_date_start, $request->issue_date_end])
                ->where('subject','like', '%'.$request->subject.'%');
        }elseif($request->issue_date_start != null && $request->issue_date_end == null){
            $receives = Rceive::where('issue_date', '>', $request->issue_date_start)
                ->where('subject','like', '%'.$request->subject.'%');
        }elseif($request->issue_date_start == null && $request->issue_date_end != null){
            $receives = Rceive::where('issue_date', '<', $request->issue_date_end)
                ->where('subject','like', '%'.$request->subject.'%');
        }else{
            $receives = Rceive::where('subject','like', '%'.$request->subject.'%');
        }

        if($request->client != null){
            $receives = $receives->where('client_id','=', $request->client);
        }

        if($request->estimate_id != null){
            $estimate = Estimate::where('estimate_no','=', $request->estimate_id)->first();
            $estimate_id = $estimate->id;
            $receives = $receives->where('estimate_id','=', $estimate_id);
        }

        if($request->person != null){
            $receives = $receives->where('person_id','=', $request->person);
        }

        if($request->status != null){
            $receives = $receives->where('status','=', $request->status);
        }

        
        $receives = $receives->orderBy('issue_date','desc')->paginate(5);
        return view('receives.searchindex', compact('receives', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('receives.create');
    }

    public function estimatecreate(Estimate $estimate)
    {
        return view('receives.estimatecreate', compact('estimate'));
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
            'receive_no'=> 'required',
            'subject'=>'required',
            'issue_date'=> 'required',
            'person_id'=>'required',
            'client_id'=> 'required',
            'delivery_line'=>'required',
            'issue_date'=> 'required',
            'pay_requirement'=>'required',
        ]);

        $receive = new Rceive();
        $receive->receive_id = $request->input('receive_no');
        $receive->client_id = $request->input('client_id');
        $receive->subject = $request->input('subject');
        $receive->issue_date = $request->input('issue_date');
        $receive->person_id = $request->input('person_id');
        $receive->client_id = $request->input('client_id');
        $receive->delivery_line = $request->input('delivery_line');
        $receive->delivery_place = $request->input('delivery_place');
        $receive->pay_requirement = $request->input('pay_requirement');
        $receive->receive_requirement = $request->input('receive_requirement');
        $receive->note = $request->input('note');
        $receive->save();

        return redirect()->route('receives.index');
    }

    public function estimatestore(Request $request, Estimate $estimate)
    {
        $request->validate([
            'receive_no'=> 'required',
            'subject'=>'required',
            'issue_date'=> 'required',
            'person_id'=>'required',
            'client_id'=> 'required',
            'delivery_line'=>'required',
            'issue_date'=> 'required',
            'pay_requirement'=>'required',
        ]);

        $receive = new Rceive();
        $receive->receive_id = $request->input('receive_no');
        $receive->client_id = $request->input('client_id');
        $receive->subject = $request->input('subject');
        $receive->issue_date = $request->input('issue_date');
        $receive->person_id = $request->input('person_id');
        $receive->client_id = $request->input('client_id');
        $receive->delivery_line = $request->input('delivery_line');
        $receive->delivery_place = $request->input('delivery_place');
        $receive->pay_requirement = $request->input('pay_requirement');
        $receive->receive_requirement = $request->input('receive_requirement');
        $receive->note = $request->input('note');
        $receive->estimate_id = $estimate->id;
        $receive->sum_price = $estimate->sum_price;
        $receive->save();

        // 明細の保存
        $details = Estimatedetail::where('estimate_id',$estimate->id)->get();
        foreach($details as $detail){
            $receivedetail = new Receivedetail();
            $receivedetail->receive_id = $receive->id;
            $receivedetail->product_id = $detail->product_id;
            $receivedetail->product_count = $detail->product_count;
            $receivedetail->price = $detail->price;
            $receivedetail->sum_price = $detail->sum_price;
            $receivedetail->save();
        }

        // 見積ステータスの変更
        $estimate->status = 4;
        $estimate->save();

        return redirect()->route('receives.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rceive  $rceive
     * @return \Illuminate\Http\Response
     */
    public function show(Rceive $receive)
    {
        $companyinf = [
            'name' => Fixvalue::where('id',1)->value('fixvalue'),
            'post' => Fixvalue::where('id',2)->value('fixvalue'),
            'address' => Fixvalue::where('id',3)->value('fixvalue'),
            'phone' => Fixvalue::where('id',4)->value('fixvalue'),
        ];

        $receivedetails = Receivedetail::where('receive_id',$receive->id)->get();
        $receivedetails_count = $receivedetails->count();

        return view('receives.show', compact('receive','companyinf','receivedetails','receivedetails_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rceive  $rceive
     * @return \Illuminate\Http\Response
     */
    public function edit(Rceive $receive)
    {
        return view('receives.edit', compact('receive'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rceive  $rceive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rceive $receive)
    {
        $request->validate([
            'receive_id'=> 'required',
            'subject'=>'required',
            'issue_date'=> 'required',
            'person_id'=>'required',
            'client_id'=> 'required',
            'delivery_line'=>'required',
            'issue_date'=> 'required',
            'pay_requirement'=>'required',
        ]);

        $receive->receive_id = $request->input('receive_id');
        $receive->client_id = $request->input('client_id');
        $receive->subject = $request->input('subject');
        $receive->issue_date = $request->input('issue_date');
        $receive->person_id = $request->input('person_id');
        $receive->client_id = $request->input('client_id');
        $receive->delivery_line = $request->input('delivery_line');
        $receive->delivery_place = $request->input('delivery_place');
        $receive->pay_requirement = $request->input('pay_requirement');
        $receive->receive_requirement = $request->input('receive_requirement');
        $receive->note = $request->input('note');
        $receive->save();

        return redirect()->route('receives.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rceive  $rceive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rceive $receive)
    {
        $receive->delete();
        return redirect()->route('receives.index');
    }

    public function confirm(Rceive $receive)
    {
        $receive->status = 1;
        $receive->save();

        return redirect()->route('receives.show', ['receive' => $receive->id]);
    }

    public function estimateindex(){
        $estimates = Estimate::where('status','=','2')->orderBy('issue_date','desc')->paginate(5);
        return view('receives.estimateindex', compact('estimates'));
    }

    public function searchestimateindex(){
        $estimates = Estimate::where('status','=','2')->orderBy('issue_date','desc')->paginate(5);
        return view('receives.searchestimateindex', compact('estimates'));
    }
}

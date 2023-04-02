<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Rceive;
use App\Models\Receivedetail;
use App\Models\Fixvalue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::orderBy('issue_date','desc')->paginate(5);
        return view('bills.index', compact('bills'));
    }

    public function searchindex(Request $request)
    {
        $bills = Bill::query();
        if($request->issue_date_start != null && $request->issue_date_end != null){
            $bills->whereBetween('issue_date', [$request->issue_date_start, $request->issue_date_end]);
        }elseif($request->issue_date_start != null && $request->issue_date_end == null){
            $bills->where('issue_date', '>', $request->issue_date_start);
        }elseif($request->issue_date_start == null && $request->issue_date_end != null){
            $bills->where('issue_date', '<', $request->issue_date_end);
        }

        if($request->subject != null){
            $receives = Rceive::where('subject','like', '%'.$request->subject.'%')->get();
            $receive_id = [];
            foreach($receives as $receive){
                $receive_id[] = $receive->id;
            }
            $bills->whereIn('rceive_id', $receive_id);
        }
        

        if($request->client != null){
            $receives_client = Rceive::where('client_id','=',$request->client)->get();
            Log::debug($receives_client);
            $receive_id_client = [];
            foreach($receives_client as $receive_client){
                $receive_id_client[] = $receive_client->id;
            }
            $bills->whereIn('rceive_id', $receive_id_client);
        }

        if($request->person != null){
            $bills = $bills->where('person_id','=', $request->person);
        }

        if($request->status != null){
            $bills = $bills->where('status','=', $request->status);
        }

        
        $bills = $bills->orderBy('issue_date','desc')->paginate(5);
        return view('bills.searchindex', compact('bills', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Rceive $receive)
    {
        return view('bills.create', compact('receive'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Rceive $receive)
    {
        $request->validate([
            'bill_id'=> 'required',
            'subject'=>'required',
            'issue_date'=> 'required',
            'person_id'=>'required',
            'client_id'=> 'required',
            'payment_date'=> 'required'
        ]);

        $bill = new Bill();
        $bill->bill_id = $request->input('bill_id');
        $bill->rceive_id = $request->input('receive_id');
        $bill->issue_date = $request->input('issue_date');
        $bill->person_id = $request->input('person_id');
        $bill->note = $request->input('note');
        $bill->payment_date = $request->input('payment_date');
        $bill->save();

        $receive->status = 2;
        $receive->save();

        return redirect()->route('bills.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        $companyinf = [
            'name' => Fixvalue::where('id',1)->value('fixvalue'),
            'post' => Fixvalue::where('id',2)->value('fixvalue'),
            'address' => Fixvalue::where('id',3)->value('fixvalue'),
            'phone' => Fixvalue::where('id',4)->value('fixvalue'),
            'payinf' => Fixvalue::where('id',5)->value('fixvalue')
        ];

        $details = Receivedetail::where('receive_id',$bill->rceive->id)->get();
        $details_count = $details->count();

        return view('bills.show', compact('bill','companyinf','details','details_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        return view('bills.edit',compact('bill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'bill_id'=> 'required',
            'subject'=>'required',
            'issue_date'=> 'required',
            'person_id'=>'required',
            'client_id'=> 'required',
            'payment_date'=> 'required'
        ]);

        $bill->bill_id = $request->input('bill_id');
        $bill->issue_date = $request->input('issue_date');
        $bill->person_id = $request->input('person_id');
        $bill->note = $request->input('note');
        $bill->payment_date = $request->input('payment_date');
        $bill->save();

        return redirect()->route('bills.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }

    public function confirm(Bill $bill)
    {
        $bill->status = 1;
        $bill->save();

        return redirect()->route('bills.show', ['bill' => $bill->id]);
    }

    public function process(Bill $bill)
    {
        $bill->status = 2;
        $bill->save();

        return redirect()->route('bills.show', ['bill' => $bill->id]);
    }
}

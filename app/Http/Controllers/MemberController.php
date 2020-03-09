<?php

namespace App\Http\Controllers;

use App\Member;
use App\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MemberController extends Controller
{
    
    // For receipt
    public $studentfee = 750;
    public $regularfee = 750;
    public $membershipfee = 250;
    
    public function index()
    {
        $members = Member::orderBy('updated_at', 'desc')->get();
        $active = Member::where('validity', '>=', Carbon::now())->count();
        Member::where('validity', '<', Carbon::now())->update(['status' => 'Expired']);

        return view('members')->with([
            "members" => $members,
            "active" => $active
            ]);
    }

    public function create(Request $request)
    {
        $member = new Member;
        $member->firstname = $request->firstname;
        $member->lastname = $request->lastname;
        $member->address = $request->address;
        $member->contact = $request->contact;
        $member->sex = $request->sex;
        $member->validity = Carbon::now();
        $member->status = "Pending";
        $member->type = $request->type;        

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images/members').$imageName);
        $member->image = $imageName;

        $member->save();

        $amount = $request->validity * (($request->type == "Student")?$this->studentfee:$this->regularfee);
        $grandtotal = $amount + $this->membershipfee;
        $payment = [
            "membershipfee" => $this->membershipfee,
            "number"        => $request->validity,
            "amount"        => $amount,
            "grandtotal"    => $grandtotal
        ];
        
        return view('receiptmember')
             ->with([
                 "member" => $member,
                 "payment" => $payment
                ]);
    }

    public function initialPayment(Request $request)
    {

        $member = Member::find($request->member_id);
        $member->status = "Active";
        $member->validity = Carbon::now()->addMonths($request->quantity);
        $member->save();

        $transaction = new Transaction;
        $transaction->name = "Membership Fee";
        $transaction->quantity = 1;
        $transaction->price = $this->membershipfee;
        $transaction->member_id = $request->member_id;
        $transaction->save();

        $transaction2 = new Transaction;
        $transaction2->name = "Monthly Fee";
        $transaction2->quantity = $request->quantity;
        $transaction2->price = $request->quantity * (($member->type == "Student")?$this->studentfee:$this->regularfee);
        $transaction2->member_id = $request->member_id;
        $transaction2->save();

        return redirect('members');
    }

    public function viewMember($id)
    {
        $member = Member::findOrFail($id);
        $transactions = Transaction::where('member_id', $id)->orderBy('created_at', 'desc')->get();
        return view('viewmember')->with(['member' => $member, 'transactions' => $transactions]);
    }
    
    public function renew($id)
    {
        $member = Member::findOrFail($id);

        return view('renew')->with(['member' => $member, 'studentfee' => $this->studentfee, 'regularfee' => $this->regularfee]);
    }

    public function extend(Request $request)
    {
        $member = Member::findOrFail($request->member_id);
        if($member->status == "Expired" || $member->status == "Pending"){
            $member->validity = Carbon::now()->addMonths($request->number);
            $member->status = "Active";
        }else{
            $validity = new Carbon($member->validity);
            $member->validity = $validity->addMonths($request->number);
        }        
        $member->save();

        $transaction = new Transaction;
        $transaction->name = "Monthly Fee";
        $transaction->quantity = $request->number;
        $transaction->price = $request->number * (($member->type == "Student")?$this->studentfee:$this->regularfee);
        $transaction->member_id = $request->member_id;
        $transaction->save();

        return redirect('members');
    }

    public function edit($id){
        $member = Member::find($id);
        return view('editmember')->with(['member' => $member]);
    }

    public function update(Request $request)
    {
        $member = Member::find($request->member_id);
        $member->firstname = $request->firstname;
        $member->lastname = $request->lastname;
        $member->address = $request->address;
        $member->contact = $request->contact;
        $member->sex = $request->sex;
        $member->type = $request->type;
        $member->save();

        return redirect('members');
    }
}

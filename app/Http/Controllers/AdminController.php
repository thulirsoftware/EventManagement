<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\NonMember;
use Hash;
use Storage;
use DB;
use App\Member;
use File;
use App\User;
use App\School;
use App\MembershipConfig;
use Carbon\Carbon;
use App\FamilyMember;
use App\PurchasedEventEntryTickets;
use App\PurchasedEventFoodTickets;
use App\MembershipBuy;
use App\Volunteer;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now()->format('Y-m-d');
            $MembershipBuy = MembershipBuy::where('payment_status','Completed')->pluck('user_id');
            $members = Member::whereIn('Member_Id',$MembershipBuy)->where('membershipExpiryDate','>=',$date)->get();

            return view('admin.memberDetails',compact('members'));
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function admin_edit_profile()
    {
        return view('admin.admin_edit_profile');
    }
    
   
    
    public function addedtickets()
    {
        return view('admin.addedtickets');
    }


    public function addAdmin()
    {
        $membername = Member::where('membershipType','!=',null)->where('membershipExpiryDate','!=',null)->get();
        $memberemail = Member::where('membershipType','!=',null)->where('membershipExpiryDate','!=',null)->get();
        return view('admin.addAdminForm',compact('membername','memberemail'));
    }

    public function addAdminPost(Request $request)
    {
        $admin = new Admin;
        $admin->name = $request->firstname;
        $admin->job_title = $request->role;
        $admin->email = $request->userName;
        $admin->is_active = $request->is_active;
        $admin->is_deleted = 'yes';
        $admin->password = Hash::make($request->password);
        $admin->save();
       return redirect('/admin/manageAdmin')->withSuccess('Admin Added Successfully');

    }

    public function manageAdmin()
    {
        $admins = Admin::where('is_deleted','yes')->get();
        return view('admin.manageAdmin',compact('admins'));
    }

    public function adminEdit($id)
    {
        $admin['admin'] = Admin::find($id);

        return view('admin.addAdminEditForm',$admin);
    }

    public function adminUpdate(Request $request)
    {
        $admin = Admin::find($request->id);
            $admin->name = $request->firstname;
            $admin->email = $request->userName;
            $admin->job_title = $request->role;
            if($admin->save()){

                      return redirect('/admin/manageAdmin')->withSuccess('Admin Updated Successfully');

            
            }else{

                       return redirect('/admin/manageAdmin')->withSuccess('Admin Updated Successfully');

            }
    }

    public function adminDelete(Request $request)
    {
        $admin = Admin::find($request->id);

        if($admin->delete()){

             echo json_encode($request->id); 

        }else{
            
             echo json_encode($request->id); 
        }
    }


        public function memberDetails()
        {
            $date = Carbon::now()->format('Y-m-d');
            $MembershipBuy = MembershipBuy::where('payment_status','Completed')->pluck('user_id');
            $members = Member::whereIn('user_id',$MembershipBuy)->where('membershipExpiryDate','>=',$date)->get();

            return view('admin.memberDetails',compact('members'));
        }

        public function viewFamilyMember($id)
        {
            $FamilyMember = FamilyMember::where('user_id',$id)->get();
            return view('admin.viewFamilyMember',compact('FamilyMember'));
        }


        public function nonMemberDetails()
        {
             $date = Carbon::now()->format('Y-m-d');


            $members = Member::where('membershipExpiryDate','<=',$date)->get();
            $NonMember = NonMember::get();

        $members = $members->merge($NonMember);

            return view('admin.nonMemberDetails',compact('members'));
        }



        public function editMember($id)
        {

            $member = Member::where('id',$id)->first();
            $user = User::where('email',$member->primaryEmail)->first();

            return view('user.editMember',compact('member','user'));
        }

        public function editMemberUpdate(Request $request)
        {

            $member = Member::where('id',$request->memberId)->update([
                'firstName' => $request->firstName,
                'primaryEmail' => $request->email,
                'lastName' => $request->lastName,
            ]);

            $user = User::where('id',$request->userId)->update([
                'name' => $request->firstName,
                'email' => $request->email,
            ]);
           
            return redirect('/admin/memberDetails');
        }



    public function FoodTicketsReport()
    {
        $PurchasedEventFoodTickets = PurchasedEventFoodTickets::where('ticketQty','!=',null)->where('ticketQty','!=',0)->get();
        return view('admin.PurchasedEventFoodTickets',compact('PurchasedEventFoodTickets'));
    }

    public function EntryTicketsReport()
    {
        $PurchasedEventEntryTickets = PurchasedEventEntryTickets::where('ticketQty','!=',null)->get();
        return view('admin.PurchasedEventEntryTickets',compact('PurchasedEventEntryTickets'));
    }

    public function VolunteerReports()
    {
        $Volunteers = Volunteer::get();
        return view('admin.volunteer_reports',compact('Volunteers'));
    }

    public function PaymentList()
    {
        $MembershipBuy = MembershipBuy::get();
        return view('admin.payment.list',compact('MembershipBuy'));
    }

    public function PaymentEdit($id)
    {
        $MembershipBuy = MembershipBuy::where('id',$id)->first();
        return view('admin.payment.edit',compact('MembershipBuy'));
    }

    public function UpdatePayment(Request $request)
    {
        $membershipBuy = MembershipBuy::find($request->id);
        $membershipBuy->Inst_Type = $request->paymentType;
        $membershipBuy->Inst_No = $request->Inst_number;
        $membershipBuy->payment_status = $request->payment_status;
        $membershipBuy->save();
        
        $member = Member::where('user_id',$request->user_id)->first();
        if($member==null)
        {
              $NonMember = NonMember::where('user_id',$request->user_id)->first();
       }
        else
       {
                $NonMember = Member::where('user_id',$request->user_id)->first();
        }

      

        $user = User::whereRaw('id = (select max(`id`) from users)')->get()->toArray();

        if($user){
        $userId=$user[0]['id'];

        $Member_Id='NETS'.sprintf("%07d", ++$userId);
        }else{
            $Member_Id = "NETS0000001";
        }
        $this_year =  Carbon::now()->format('Y');
        if($member==null)
        {

            $Member = new Member();
            $Member->Member_Id = $Member_Id;
            $Member->firstName = $NonMember->firstName;
            $Member->lastName = $NonMember->lastName;
            $Member->mobile_number = $NonMember->mobile_number;
            $Member->Email_Id = $NonMember->Email_Id;
            $Member->user_id = $request->user_id;
            $Member->addressLine1 = $NonMember->addressLine1;
            $Member->addressLine2 = $NonMember->addressLine2;
            $Member->country = $NonMember->country;
            $Member->state = $NonMember->state;
            $Member->zipCode = $NonMember->zipCode;
            $Member->gender = $NonMember->gender;
            $Member->dob = $NonMember->dob;
            $Member->maritalStatus = $NonMember->maritalStatus;
            $Member->membershipAmount = $request->membershipAmount;
            $Member->membershipType =$request->membershipType;
            $Member->membershipExpiryDate = $request->closing_date;
            
            if($Member->save()){
                $User = User::find($request->user_id);
                $User->Member_Id = $Member_Id;
                $User->save();
                
                $FamilyMember = FamilyMember::where('user_id',$request->user_id)->first();
                if($FamilyMember)
                {
                    $FamilyMember->Member_Id = $Member_Id;
                    $FamilyMember->save();
                }
                
                $NonMember = NonMember::where('user_id',$request->user_id)->delete();
            }
        }
        else
        {
            $Member = Member::where('Email_Id',$NonMember->Email_Id)->first();
            $Member->membershipExpiryDate =$request->closing_date;
            $Member->save();

        }

            

       return redirect('/admin/Payments')->withSuccess('Membership Updated Successfully');
        }

    /**** User Membership Update*******/

    public function EditMembership($id)
    {
        $MembershipBuy = MembershipBuy::where('user_id',$id)->orderby('id','desc')->first();
        $MembershipCode = MembershipConfig::orderby('id','desc')->get();
        $MembershipAmount = MembershipConfig::orderby('id','desc')->get();
        return view('admin.member.membership_edit',compact('MembershipBuy','MembershipAmount','MembershipCode'));
    }

    public function UpdateMembership(Request $request)
    {

        $MembershipBuy = MembershipBuy::where('user_id',$request->user_id)->orderby('id','desc')->first();
        $MembershipBuy->membership_code = $request->membershipType;
        $MembershipBuy->membership_amount = $request->membershipAmount;
        if($MembershipBuy->save())
        {
            $Member = Member::where('user_id',$request->user_id)->first();
            $Member->membershipType =$request->membershipType;
            $Member->membershipAmount = $request->membershipAmount;
            $Member->save();
        }
        return redirect()->back()->withSuccess('Membership Updated Successfully');
    }
    


}

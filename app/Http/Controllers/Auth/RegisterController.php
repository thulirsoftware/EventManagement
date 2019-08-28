<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
//use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Member;
use App\FamilyMember;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'phoneNo1' => 'required|max:10|min:10',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

    //     $dateLength = strlen($data['dobDate']);
    //     $monthLength = strlen($data['dobMonth']);
    //     if($dateLength == 1){
    //         $data['dobDate'] = "0".$data['dobDate'];
    //     }
    //     if($monthLength == 1){
    //         $data['dobMonth'] = "0".$data['dobMonth'];
    //     }

    //     $data['dob'] = $data['dobDate']."/".$data['dobMonth'];
    // //$membershipExpiry = date('Y-m-d', strtotime('+1 years'));

        $user = User::whereRaw('id = (select max(`id`) from users)')->get()->toArray();

        if($user){
        $userId=$user[0]['id'];

        $tagDvId='TDV'.sprintf("%07d", ++$userId);
        }else{
            $tagDvId = "TDV0000001";
        }

        $member = Member::create([
            'firstName' => $data['name'],
            'lastName' => $data['lastName'],
            'primaryEmail' => $data['email'],
            'secondaryEmail' => "", 
            'tagDvId' => $tagDvId,
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'mob' => $data['mob'],
            'maritalStatus' => $data['maritalStatus'],
            'phoneNo1' => $data['phoneNo1'],
            'phoneNo2' => $data['spousePhoneNo'],
            'addressLine1' => $data['address1'],
            'addressLine2' => $data['address2'],
            'country' => $data['city'],
            'state' => $data['state'],
            'zipCode' => $data['zipCode'],
            'membershipType' => "",
            'membershipExpiryDate' => "",
        ]);


        if($data['spouseFName'] != ""){
        $familyMember = FamilyMember::create([
            'tagDvId' => $tagDvId,
            'firstName' => $data['spouseFName'],
            'lastName' => $data['spouseLName'],
            'relationshipType' => "", 
            'phoneNo' => $data['spousePhoneNo'],
            'dob' => "",
            'schoolName' => "",
        ]);
    }   

    if($data['firstChildName'] != ""){
        $familyMember = FamilyMember::create([
            'tagDvId' => $tagDvId,
            'firstName' => $data['firstChildName'],
            'lastName' => "",
            'relationshipType' => "", 
            'phoneNo' => "",
            'dob' => "",
            'schoolName' => $data['child1SchoolName'],
        ]);
    } 

    if($data['secondChildName'] != ""){
        $familyMember = FamilyMember::create([
            'tagDvId' => $tagDvId,
            'firstName' => $data['secondChildName'],
            'lastName' => "",
            'relationshipType' => "", 
            'phoneNo' => "",
            'dob' => "",
            'schoolName' => $data['child2SchoolName'],
        ]);
    } 

    if($data['thirdChildName'] != ""){
        $familyMember = FamilyMember::create([
            'tagDvId' => $tagDvId,
            'firstName' => $data['thirdChildName'],
            'lastName' => "",
            'relationshipType' => "", 
            'phoneNo' => "",
            'dob' => "",
            'schoolName' => $data['child3SchoolName'],
        ]);
    }   



        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'user_type' => $data['userType'],
            'tagDvId' => $tagDvId,
            'password' => bcrypt($data['password']),
            'token' => str_random(25),
        ]);

        //$user->notify(new VerifyEmail($user));
        $user->sendVerificationEmail();

        return $user;
    }
}

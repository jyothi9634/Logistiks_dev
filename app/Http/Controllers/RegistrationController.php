<?php
/************************************
 * Purpose : Member , Individual , MarketPlace Registrations
 * Author : Nikhil Kishore
 * Company : Logistiks
 * Description : In the controller we are handling the member registration process of logistiks.
 * Created At : 05th Aug 2016
 * 
 *
 */
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Console\IlluminateCaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

class RegistrationController extends BaseController
{
 /*
  * Method Name :
  * Purpose :
  * 
  */  
  public function index()
  {
      return view('registration');
  } 
 
  public function store(){
   
       //storing the registration fields into database
      
      try{
       
       // verifying if the username and password exists or not
          
       $if_not_exists = DB::table('lgtks_users')
                         ->where(array('user_name'=>Input::get('user_name'),
                         'current_password'=>Input::get('password')))->get();   
        
        //Inserting new username and password for registration 
       
       $firstname = Input::get('first_name');
       
       if(empty($if_not_exists) && empty($firstname)){
       
         $regist_Id = DB::table('registrations')->insertGetId([
                    'email_id'=>Input::get('email'),
                    'mobile_number'=>Input::get('mobile_number'),
                    ]);
          
        Session::put('RegistrationId',$regist_Id); 
        
        DB::table('lgtks_users')->insert([
          'user_name'=>Input::get('user_name'),
          'email_id'=>Input::get('email'),
          'current_password'=>Input::get('password'),
          'mobile_number'=>Input::get('mobile_number'),
          'lgtks_registrations_id'=>$regist_Id,   
          ]);
          
        
         $message = "Successfully Updated User Details";
         
         return Redirect::to('/individualRegistration');
         
         }
         
     else{
         
        //User already registered in MemberRegistration 
         $message = "User already registered";
         
         }
        
        }
      catch(Exception $e){
      
        //Handling the error exceptions        
        
          $message=$e->getMessage();
      }
      
   return Response::json(['Message'=>$message]); 
    
   
      }
    
  public function indvReg(){
 
      return view('indvReg');
  }
  
  public function storeIndvReg(){
      try{
          
          if(!empty(Input::get('first_name'))){
          
            $session_reg_id =Session::get('RegistrationId');
              
            DB::table('registrations')
            ->where('id',$session_reg_id)
            ->update(array('first_name'=>Input::get('first_name'),
            'last_name'=>Input::get('last_name'),
            'pincode'=>Input::get('pincode'),
            'mobile_number'=>Input::get('mobile_number'),   
            'landline_number'=>Input::get('landline_number'),
            'address_line1'=>Input::get('address1'),
            'email_id'=>Input::get('email'),
            'alternative_email_id'=>Input::get('alternate_email')));
                 
          //Updation of Registrations in Individual registration
         $message = "Successfully registered";
         
         }
         
        return Response::json(['Message'=>$message]); 
        
      } catch (Exception $ex) {
          $message = $ex->getMessage();
      }
  }
      
 }

<?php

/* * **********************************
 * Purpose : Member , Individual , MarketPlace Registrations
 * Author : Nikhil Kishore
 * Company : Logistiks
 * Description : In the controller we are implementing Buyer Search Functionality
 * Created At : 06th Aug 2016
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
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\BuyerSearch;
use App\Components\BuyerSearchComponent;
use App\Components\SellerPostComponent;

class BuyerSearchController extends BaseController {
   
    /*
     * Method Name :Construct
     * Purpose : Configuring Model 
     * 
     */
    
    public function __construct(BuyerSearch $BuyerSearch){
        
        $this->buyer = $BuyerSearch;
    }
    /*
     * Method Name :Index
     * Purpose : Redirection to Buyer Search View
     * 
     */
    public function index() {
        
        $data = SellerPostComponent::GetData();
        
        return view('buyers.search', ['data' => $data]);
       
    }
    
    /*
     * Method Name :SearchBuyer
     * Purpose : Buyer Search results with required elements
     * 
     */

    public function buyerSearch() {

        try {
            
            $data = Input::all();
            
            if ($data != NULL) {

                if ($data['from_loc'] != NULL && $data['to_loc'] != NULL && $data['dispatch_dt'] != NULL && $data['delivery_dt'] != NULL && $data['load_type'] != NULL && $data['veh_type'] != NULL) {
                    
                    $message = BuyerSearchComponent::SellerPosts($data);
                    
                      
                }
            } else {
                
                $message = "No Records Found";
            }
        } catch (Exception $ex) {

            $message = $ex->getMessage();
        }
           
        return $message;
    }
    
    /*
     * Method Name :BookNow
     * Purpose : Redirect to BuyerBookNow View page
     * 
     */
    
    public function bookNow(){
        try{
            
             $data = ['user_id' => '3',
                'user_name' => 'Nikhil Kishore',
                'from_loc' => 'Hyd',
                'to_loc' => 'Kakinada',
                'dispatch_dt' => '2016/08/19',
                'delivery_dt' => '2016/08/21',
                'load_type' => 'Fertiliser',
                'veh_type' => 'LPT 9 MT',
                'qty' => '10',
                'load_commitment_per_day' => '1',
                'transit_days' => '5',
                'price' => '1000',
                'tracking_type' => 'Real Time',
                'payment_term' =>'Advance(Credit Card/NEFT/RTGS)',
                ];
              
            $buyer_booknow_details = $this->buyer->buyerBooknow($data['user_id']);
            
            return view('Buyers.booknow',['data'=>$data,'buyer_booknow_details'=>$buyer_booknow_details]);
            
        
             
        } catch (Exception $ex) {
            
           return $ex->getMessage();
        }
    }

    public function buyercheckOut(){
        try{
             
             
             return view('buyercheckout');

        
        }
        catch(Exception $ex){

            return $ex->getMessage();
        }
    }
}

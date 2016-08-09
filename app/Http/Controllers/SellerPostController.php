<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Components\SellerPostComponent;
use Redis;

class SellerPostController extends Controller{
    public function index(){
        
        $data =SellerPostComponent::GetData();
        return view('Buyers.form',['data'=>$data]);
        
    }
        
        public function check(Request $request)
        {
            $id = 0;
            $app = app();
            
            if($app['redis']->connection())
                {       
                  $redis = Redis::connection();
                    if($request->input('post_title') != NULL){
                       $title = $request->input('post_title');
                    }else{
                        exit;
                    }
                
                    if($request->input('frm_loc') != NULL){
                       $frm_loc        = $request->input('frm_loc');
                    }else{
                        exit;
                    }
                    
                    if($request->input('to_loc') != NULL){
                       $to_loc       = $request->input('to_loc');
                    }else{
                        exit;
                    }
                
                    if($request->input('dispatch_dt') != NULL){
                       $dispatch_dt        = $request->input('dispatch_dt');
                       $dispatch           = date('Y-m-d', strtotime($dispatch_dt));

                    }else{
                        exit;
                    }
                
                    if($request->input('delivery_dt') != NULL){
                        $delivery_dt        = $request->input('delivery_dt');
                        $delivery           = date('Y-m-d', strtotime($delivery_dt));
                    }else{
                        exit;
                    }
                
                    if($request->input('load_typ') != NULL){
                       $load_typ       = $request->input('load_typ');
                    }else{
                        exit;
                    } 
                    
                    if($request->input('veh_typ') != NULL){
                       $veh_typ       = $request->input('veh_typ');
                    }else{
                        exit;
                    }
                
                    if($request->input('load_limit') != NULL){
                       $load_limit       = $request->input('load_limit');
                    }else{
                        exit;
                    }
                
                    if($request->input('price') != NULL){
                       $price       = $request->input('price');
                    }else{
                        exit;
                    }
                
                    if($request->input('transit_days') != NULL){
                       $transit_days     = $request->input('transit_days');
                    }else{
                        exit;
                    }
                
                    if($request->input('book_cutoff') != NULL){
                       $book_cutoff        = $request->input('book_cutoff');
                    }else{
                        exit;
                    }
                
                    if($request->input('tracking') != NULL){
                       $tracking        = $request->input('tracking');
                    }else{
                        exit;
                    }
//                        $title        = $request->input('post_title');
//                        $frm_loc      = $request->input('frm_loc');
//                        $to_loc       = $request->input('to_loc');
//                        $dispatch_dt  = $request->input('dispatch_dt');
//                        $delivery_dt  = $request->input('delivery_dt');
//                        $load_typ     = $request->input('load_typ');
//                        $qty          = $request->input('qty');
//                        $veh_typ      = $request->input('veh_typ');
//                        $load_limit   = $request->input('load_limit');
//                        $price_type   = $request->input('price_type');
//                        $price        = $request->input('price');
//                        $transit_days = $request->input('transit_days');
//                        $book_cutoff  = $request->input('book_cutoff');
//                        $tracking = $request->input('tracking');

                         if(!empty($_POST['checkbox'])){
                             $pay_term = [];
                             foreach($_POST['checkbox'] as $payment){
                                //echo $payment;
                                array_push($pay_term,$payment);
                            }
                             //$pay_terms= implode(',',$pay_term);
                             //print_r($pay_term[0]);
                         }
               
        $data=['title'=>$title,'from_loc'=>$frm_loc,'to_loc'=>'2','dispatch_dt'=>$dispatch,'delivery_dt'=>$delivery,'load_type'=>$load_typ,'veh_type'=>$veh_typ,'load_commitment_per_day'=>$load_limit,'price_type'=>'1','price'=>$price,'transit_days'=>$transit_days,'payment_term'=>'1','tracking_type'=>$tracking,'contract_type'=>'1','seller_buyer_flag'=>'1'];
                
                 if($data != NULL){
                   SellerPostComponent::SellerComponent($data);
                }else{
                    return redirect()->back();
                }
             }
        }

}
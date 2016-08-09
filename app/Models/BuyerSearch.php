<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Components\SearchForSellerPostsComponent;
use DB;


class BuyerSearch extends Model
{
    public static function SearchForSellerPost($data){
    try{
     
     $base_table =  DB::table('lgtks_posts as lp')
                       ->leftjoin('pincode_location_details as pld','pld.id','=','lp.from_loc')
                       ->leftjoin('pincode_location_details as pldd','pldd.id','=','lp.to_loc')
                       ->leftjoin('vehicle_types as vt','vt.id','=','lp.veh_type')
                       ->leftjoin('load_types as lt','lt.id','=','lp.load_type');
     
     
     $whereCondition = array('pld.district_name' =>$data['from_loc'],
                    'pldd.district_name'=> $data['to_loc'],
                    'lp.dispatch_dt'=>date('Y-m-d',strtotime($data['dispatch_dt'])),
                    'lp.delivery_dt'=>date('Y-m-d',strtotime($data['delivery_dt'])),
                    'lp.load_type'=>$data['load_type'],
                    'lp.veh_type'=>$data['veh_type']);
                
    if($data['qty'] != NULL ){
        
        $whereCondition['lp.qty'] = $data['qty'];
    }
    
    $db_query = $base_table->where($whereCondition)->get();
        
    return $db_query;
    
    }
    catch(Exception $ex){
        
       return $ex->getMessage();
    }
    
    
    }
   
    public function buyerBooknow($user_id){
        try{
            
            $location_types     = DB::table('pickup_location_types')->get();
            $packing_types      = DB::table('packaging_types')->get();
            $consignment_types  = DB::table('consignment_type')->get();
            $user_details       = DB::table('lgtks_users as lu')
                                  ->leftjoin('registrations as rg','rg.id','=','lu.lgtks_registrations_id')
                                  ->where('lu.id',$user_id)->get();
            
            return ['location_types' => $location_types,'packing_types'=>$packing_types,'consignment_types'=>$consignment_types,'user_details'=>$user_details];
            
        } catch (Exception $ex) {

        }
    }
   
}
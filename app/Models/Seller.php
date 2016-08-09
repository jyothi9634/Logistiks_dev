<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Components\SellerPostComponent;
use Symfony\Component\CssSelector\Node\SelectorNode;
use DB;


class Seller extends Model
{
    public static function SellerPost(){
            
            $pincodeData = DB::select('select * from pincode_location_details LIMIT 30 ');
            $paymentTermData = DB::select('select * from payment_terms');
            $trackingTypeData = DB::select('select * from tracking_types');
            $vehicleTypesData = DB::select('select * from vehicle_types');
            $loadTypesData = DB::select('select * from load_types');
            $data = ['pincodeData'=>$pincodeData , 'paymentTermData'=>$paymentTermData , 'trackingTypeData'=>$trackingTypeData , 'vehicleTypesData'=>$vehicleTypesData , 'loadTypesData'=>$loadTypesData];
            return $data;
    }
    
    public static function SellerPostInsertion($data){
        echo "sucess";
        DB::table('lgtks_posts')->insert($data);
   }
}
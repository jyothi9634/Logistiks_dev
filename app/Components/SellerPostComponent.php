<?php 
namespace App\Components;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Seller;


class SellerPostComponent{
    
    public static function SellerComponent($data){
        Seller::SellerPostInsertion($data);
    }
    public static function GetData(){
        $data = Seller::SellerPost();
        return $data;
    }
}
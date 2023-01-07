<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Invite extends Model
{
    use HasFactory;
    protected $fillable = [
        'email', 'token','user_id','event_id'
    ];

    public function getAlldata($filterData, $getCount = false) 
    {
        $dataObj = DB::table('invites' )  ;                   
        if(isset($filterDyArrReq['billing_stat']) && $filterDyArrReq['billing_stat'] !=null){
            $dataObj = $dataObj->Where('clients.status','=',$filterDyArrReq['billing_stat']);
        }    
        if($getCount){
            return $dataObj->get()->count();
        }
        if ($filterData['length'] == '-1') {
            $dataObj = $dataObj->limit($filterData['length'])->offset(0);
        } else {
            if ($filterData['length'] != '0') {
                 $dataObj = $dataObj->limit($filterData['length'])->offset($filterData['start']);
            }
        }
        if ($filterData['sortable'] == '0') {
            $dataObj = $dataObj->orderBy('id', $filterData['direction']);
        }  
        return $dataObj->get()->toArray();
    }
}


<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Redis as Redis;
use Illuminate\Support\Facades\DB;

class TestController extends BaseController
{

    public function index($id='', $name=''){
    	//abort(404);
    	//abort(403, 'Unauthorized action.');
    	
    	//redis缓存操作
    	$redis  = Redis::connection('redis2');
    	$info  	= $redis->get('operation_game_mall_test_1');
    	//print_r(json_decode($info)->status);exit;


    	//数据库操作
    	$my = DB::connection('mysql2');
    	$infos = $my->select('show tables');
    	foreach ($infos as $v) {
		    //print_r($v->Tables_in_mysql);
		    //echo "<br/>";
		}
    	
		
    	//echo 'id:'.$id, ' name:'.$name;
    	return view('child',['name'=>['emily','ivan']]);
    }




}

<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    
    public function show()
    {
        $fieldData = Setting::all();
        $timezones = DB::table('timezone')->get();
        $settings = array();
        foreach ($fieldData as $key => $value) {
            $settings[$value->key] = $value->value;
        }
        return view('administrator.settings.show',compact('settings','timezones'));
    }

    public function save(Request $request)
    {
        //
        try {
            $data = $request->all();
            unset($data['_token']);
            foreach($data as $key => $value){
                $setting = Setting::where('key', $key);    
                if($setting->exists()){
                    $setting->update(array("key"=>$key,"value"=>$value));  
                } else {
                    $setting->create(array("key"=>$key,"value"=>$value)); 
                }

            }
            return redirect()->back()->with('message', 'Page updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e->getMessage()); 
        }

    }
}

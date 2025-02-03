<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Brochure;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SettingController extends Controller
{
    
    public function show()
    {
        $fieldData = Setting::all();
        $settings = array();
        foreach ($fieldData as $key => $value) {
            $settings[$value->key] = $value->value;
        }
        return view('administrator.settings.show',compact('settings'));
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

    public function qrcode()
    {
        // $data = QrCode::size(512)
        //     ->generate(
        //         'https://twitter.com/HarryKir',
        //     );

        QrCode::generate('Welcome to Makitweb', public_path('images/qrcode.svg') );
        return view('administrator.qrcode.qrcode');
    }

    public function generateQrcode(Request $request)
    {
        try {
            $data = $request->all();
            $validatedData = $request->validate([
                'qr_content' => 'required',
            ]);

            $qr_content = $data['qr_content'];
            $code = random_strings(6);
            if(isset($data['code'])){
                $code = $data['code'];
                $qr_content = $qr_content.'?utm_campaign='.$code.'&center='.$data['center'];
            }

            QrCode::merge('/assets/images/fab.png')
            ->size(256)
            ->margin(1)
            ->generate($qr_content, public_path('images/qrcode_'.$code.'.svg'));

            $qrPath = url("public/images/qrcode_").$code.'.svg';
           return view('administrator.qrcode.generate-qrcode',compact('qrPath'));
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e->getMessage()); 
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Setting;

class SettingController extends Controller
{

    public function all($user_id)
    {

        $settings = Setting::where("user_id", $user_id)->get();
        if(count($settings ) == 0) {
           
            $setting = new Setting();
            $setting->friend_request = 'all';
            $setting->view_level = 'friend';
            $setting->notification_sound = true;
            $setting->notification_email = true;
            $setting->friend_birthday = true;
            $setting->chat_sound = true;
            $settings []= $setting;
        }
        return response()->json([
            'data' => $settings
        ], 200);
    }
    public function test() {
        return "test ok";
    }
    public function get($id)
    {
        $setting = Setting::where('id', $id)->get();

        return response()->json([
            'data' => $setting
        ], 200);
    }


    public function update(Request $request)
    {
        $setting = Setting::find($request->get("id"));

        if (empty($setting)) {
            return "No setting found with id: " . $id;
        }
        
        $setting->fill($body);
        $setting->save();
        return $setting; 
    }

    public function create(Request $request)
    {
        
        $setting = new Setting();
        $setting->fill($request->all());
        $setting->save();
        return $setting; 
    }

    public function delete($id)
    {
        Customer::where('id', $id)->delete();
        return response()->json(['message' => 'Row deleted successfully']);
    }
    
}

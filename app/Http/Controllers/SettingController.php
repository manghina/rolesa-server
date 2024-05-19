<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

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

    public function updateProfile(Request $request)
    {
        $data = $request->only(['name', 'surname', 'email', 'birthday', 'genre', 'phone', 'country', 'state', 'city', 'bio', 'website', 'religion']);
        $validator = Validator::make($data, [
            'name' => [
                'required',
                'string'
            ],
            'surname' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'string'
            ],
            'birthday' => [
                'required',
                'string'
            ],
            'genre' => [
                'required',
                'string'
            ]

        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()
                    ->toArray()
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = auth('api')->user();

        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->email = $data['email'];
        $user->birthday = $data['birthday'];
        $user->genre = $data['genre'];
//        $user->phone = $data['phone'] ? $data['phone']:  '';
//        $user->contry = $data['country'] ? $data['country']: '';
//        $user->state = $data['state'] ? $data['state']: '';
//        $user->city = $data['city'] ? $data['city']: '';
//        $user->bio = $data['bio'] ? $data['bio']: '';
//        $user->website = $data['website'] ? $data['website']: '';
//        $user->religion = $data['religion'] ? $data['religion']: '';

        $user->save();

        return response()->json($user, 200);
    }
    
}

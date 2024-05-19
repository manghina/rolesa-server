<?php

namespace App\Http\API\Controllers;
use Exception;

use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Mail\Mailer;
use App\Models\User;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->only(['name', 'email', 'password', 'birthday', 'genre','surname']);
        $validator = Validator::make($data, [
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email',
                'unique:users'
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'max:50'
            ],
            'birthday' => [
                'required',
                'date'
            ],
            'genre' => [
                'required',
                'string'
            ],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()
                    ->toArray()
            ], Response::HTTP_BAD_REQUEST);
        }
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'email_verified_token' => Str::random(40),
            'birthday' => $data['birthday'],
            'genre' => $data['genre'],
            'password' => bcrypt($data['password']),
            'phone' => '',
            'country' => '',
            'state' => '',
            'city' => '',
            'bio' => '',
        ]);
//        $mail = new Mailer($user->email_verified_token);
//        $mail->subject('Email Verification')->view('mail.test-email', ['user' => $user]);
//        Mail::to($data['email'], 'won')
//            ->send($mail);

        $credentials = $request->only(['email', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'error' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'error' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $this->respondWithToken($token);
    }

    public function user()
    {

        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60
        ]);
    }
    public function redirectToAuth($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        return response()->json([
            'url' => Socialite::driver($provider)
                         ->stateless()
                         ->redirect()
                         ->getTargetUrl(),
            'status' => Response::HTTP_OK
        ]);
    }
    public function handleAuthCallback($provider)
    {
        $validated  = $this->validateProvider($provider);
        if (!is_null($validated)) {
                return $validated;
        }
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (Exception $e) {
            
          //  return response()->json(['error' => 'Invalid  credentails']);
            return response()->json(['error' => $e->getMessage()]);
        }
        $now = now();
        $userCreated = User::firstOrCreate(
            [
                'email' => $user->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $user->getName(),
                'status' => true,
                'surname' => '',
                'birthday' => $now,
                'genre' => ' ',
                'password' => '112wdd2q4:/',
                'phone' => ' ',
                'country' => ' ',
                'state' => ' ',
                'city' => ' ',
                'bio' => ' ',
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );
        $credentials = ['email' => $user->getEmail() , 'password' => '112wdd2q4:/'];
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'error' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $this->respondWithToken($token);
    }
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['google'])) {
            return response()->json(['error' => 'Please login with google' , 422 ]);
        }
    }
}

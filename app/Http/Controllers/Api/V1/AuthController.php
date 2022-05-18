<?php

namespace App\Http\Controllers\Api\V1;

use App\Gpp\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserMeResource;
use Illuminate\Auth\Events\Registered;
use App\Gpp\Auth\Requests\LoginRequest;
use Laravel\Sanctum\PersonalAccessToken;
use App\Gpp\Auth\Requests\RegisterRequest;
use App\Gpp\Auth\repositories\AuthRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthController extends Controller
{

  private AuthRepository $authRepo;
  public function __construct(AuthRepository $authRepo)
  {
    $this->authRepo = $authRepo;
  }


  public function register(RegisterRequest $request)
  {
    return $this->authRepo->register();
  }

  public function login(LoginRequest $request)
  {
    return $this->authRepo->login();
  }

  public function logout()
  {
    return request()->user()->currentAccessToken()->delete();
  }

  public function me(Request $request)
  { 
    $user = new UserMeResource($request->user());   
    $tk = str_replace("Bearer", "",$request->header('Authorization'));
    $personalAccess = PersonalAccessToken::findToken($tk);
    return response()->json([
      'user'=> $user,
      'rps' => $personalAccess->abilities
    ]);
  }

  public function verify(Request $request)
  {
    try {
      $user = User::findOrFail(request("id"));
      if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();

        return redirect()->away('https://beta.tecbill.net/auth/email-verified');
      }
    } catch (NotFoundHttpException $th) {
      throw $th;
    }
  }

  public function resend(Request $request)
  {
    try {
      
      if ($request->email) {
        $user = User::whereEmail($request->email)->first();
        if  ($user && !$user->hasVerifiedEmail()) {
          event(new Registered($user));
        }
      }
      return response()->json([],200);
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}

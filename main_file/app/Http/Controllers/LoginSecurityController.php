<?php

namespace App\Http\Controllers;

use App\Facades\UtilityFacades;
use App\Models\LoginSecurity;
use Auth;
use Hash;
use Illuminate\Http\Request;

class LoginSecurityController extends Controller
{
    public function show2faForm(Request $request)
    {
        $user = Auth::user();
        $google2fa_url = "";
        $secret_key = "";
        if ($user->loginSecurity()->exists()) {
            $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
            $google2fa_url = $google2fa->getQRCodeInline(
                @UtilityFacades::getsettings('app_name'),
                $user->name,
                $user->loginSecurity->google2fa_secret
            );
            $secret_key = $user->loginSecurity->google2fa_secret;
        }
        $user = auth()->user();
        $role = $user->roles->first();
        $tenant_id = tenant('id');

        $data = array(
            'user' => $user,
            'secret' => $secret_key,
            'google2fa_url' => $google2fa_url,
            'tenant_id' => $tenant_id
        );
        return view('profile.index', [
            'user' => $user,
            'role' => $role,
            'secret' => $secret_key,
            'google2fa_url' => $google2fa_url,
            'tenant_id' => $tenant_id
        ]);
    }

    public function generate2faSecret(Request $request)
    {
        $user = Auth::user();
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
        $login_security = LoginSecurity::firstOrNew(array('user_id' => $user->id));
        $login_security->user_id = $user->id;
        $login_security->google2fa_enable = 0;
        $login_security->google2fa_secret = $google2fa->generateSecretKey();
        $login_security->save();
        return redirect('/2fa')->with('success', __("Secret key is generated."));
    }

    public function enable2fa(Request $request)
    {
        $user = Auth::user();
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
        $secret = $request->input('secret');
        $valid = $google2fa->verifyKey($user->loginSecurity->google2fa_secret, $secret);
        if ($valid) {
            $user->loginSecurity->google2fa_enable = 1;
            $user->loginSecurity->save();
            return redirect('2fa')->with('success', __("2FA is enabled successfully."));
        } else {
            return redirect('2fa')->with('failed', __("Invalid verification Code, Please try again."));
        }
    }

    public function disable2fa(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with("failed", __("Your password does not matches with your account password. Please try again."));
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
        ]);
        $user = Auth::user();
        $user->loginSecurity->google2fa_enable = 0;
        $user->loginSecurity->save();
        return redirect('/2fa')->with('success', __("2FA is now disabled."));
    }
}

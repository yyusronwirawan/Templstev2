<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;
use Lab404\Impersonate\Models\Impersonate;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use BelongsToTenant;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'tenant_id',
        'plan_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function loginSecurity()
    {
        return $this->hasOne('App\Models\LoginSecurity');
    }
    public function currentLanguage()
    {
        return $this->lang;
    }

    public function assignPlan($planID)
    {
        $usr  = $this;
        $plan = Plan::find($planID);
        
        if ($plan) {
            $users     = User::where('tenant_id', tenant('id'))->where('type', '!=', 'Admin')->get();
            $userCount = 0;
            
            foreach ($users as $user) {
                $userCount++;
                $user->active_status = ($plan->max_users == -1 || $userCount <= $plan->max_users) ? 1 : 0;
                $user->save();
            }
            
            $this->plan_id = $plan->id;
            if ($plan->durationtype == 'Month' && $planID != '1' ) {
                $this->plan_expired_date = Carbon::now()->addMonths($plan->duration)->isoFormat('YYYY-MM-DD');
            } elseif ($plan->durationtype == 'Year' && $planID != '1') {
                $this->plan_expired_date = Carbon::now()->addYears($plan->duration)->isoFormat('YYYY-MM-DD');
            } else {
                $this->plan_expired_date = null;
            }
            $this->save();

            return ['is_success' => true];
        } else {
            return [
                'is_success' => false,
                'error' => __('Plan is deleted.'),
            ];
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\RequestDomain;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Role;
use DB;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Stancl\Tenancy\Database\Models\Domain;
use Stancl\Tenancy\Database\Models\Tenant;
use Stancl\Tenancy\Features\UserImpersonation;


class UserController extends Controller
{

    public function index(UsersDataTable $dataTable)
    {
        if (\Auth::user()->can('manage-user')) {
            return $dataTable->render('users.index');
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function create()
    {
        if (\Auth::user()->can('create-user')) {
            if (Auth::user()->type == 'Super Admin') {
                $roles = Role::pluck('name', 'name');
                $domains = Domain::pluck('domain', 'domain')->all();
            } else {
                $roles = Role::where('name', '!=', 'Super Admin')->where('name', '!=', 'Admin')->where('tenant_id', tenant('id'))->pluck('name', 'name');
                $domains = Domain::pluck('domain', 'domain')->all();
            }
            return view('users.create', compact('roles', 'domains'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function store(Request $request)
    {
        if (\Auth::user()->can('create-user')) {
            if (\Auth::user()->type == 'Super Admin') {
                $this->validate($request, [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,',
                    'password' => 'same:confirm-password',
                ]);
                $input = $request->all();
                $input['password'] = Hash::make($input['password']);
                $input['type'] = 'Admin';
                $input['plan_id'] = 1;
                $user = User::create($input);
                $user->assignRole('Admin');
                $domain = Domain::where('domain', $request->domains)->first();
                if (tenant('id') == null) {
                    if ($domain) {
                        $user = User::find($user->id);
                        $user->tenant_id = $domain->tenant_id;
                        $user->update();
                    } else {
                        $tenant = Tenant::create(['id' => $user->id]);
                        Domain::create([
                            'domain' => $request->domains,
                            'tenant_id' => $tenant->id
                        ]);
                        $user = User::find($user->id);
                        $user->tenant_id = $tenant->id;
                        $user->update();
                        $settings = [
                            ['key' => 'app_name', 'value' => 'Multi Tenancy Laravel Admin Saas', 'tenant_id' => $tenant->id],
                            ['key' => 'app_logo', 'value' => 'logo/app-logo.png', 'tenant_id' => $tenant->id],
                            ['key' => 'app_dark_logo', 'value' => 'logo/app-dark-logo.png', 'tenant_id' => $tenant->id],
                            ['key' => 'app_small_logo', 'value' => 'logo/app-small-logo.png', 'tenant_id' => $tenant->id],
                            ['key' => 'favicon_logo', 'value' => 'logo/app-favicon-logo.png', 'tenant_id' => $tenant->id],
                            ['key' => 'default_language', 'value' => 'en', 'tenant_id' => $tenant->id],
                        ];
                        foreach ($settings as $setting) {
                            Setting::create($setting);
                        }
                        Storage::copy('logo/app-logo.png', $tenant->id . '/logo/app-logo.png');
                        Storage::copy('logo/app-dark-logo.png', $tenant->id . '/logo/app-dark-logo.png');
                        Storage::copy('logo/app-small-logo.png', $tenant->id . '/logo/app-small-logo.png');
                        Storage::copy('logo/app-favicon-logo.png', $tenant->id . '/logo/app-favicon-logo.png');
                        Storage::copy('avatar/avatar.png', $tenant->id . '/avatar.png');
                    }
                }
            } else {
                $this->validate($request, [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,',
                    'password' => 'same:confirm-password',
                    'roles' => 'required',
                ]);
                $user = Auth::user();
                $users = User::where('tenant_id', tenant('id'))->count() - 1;
                $plan       = Plan::find($user->plan_id);
                if ($users < $plan->max_users) {
                    $input = $request->all();

                    $input['password'] = Hash::make($input['password']);
                    $input['type'] = $input['roles'];
                    $user = User::create($input);
                    $user->assignRole($request->input('roles'));
                    $user->tenant_id = tenant('id');
                    $user->update();
                } else {
                    return redirect()->back()->with('failed', __('Your user limit is over, Please upgrade plan.'));
                }
            }
            return redirect()->route('users.index')->with('success', __('User created successfully'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function show($id)
    {
        if (\Auth::user()->can('show-user')) {
            $user = User::find($id);
            return view('users.show', compact('user'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function edit($id)
    {
        if (\Auth::user()->can('edit-user')) {
            $user = User::find($id);
            if (Auth::user()->type == 'Super Admin') {
                $roles = Role::pluck('name', 'name');
                $domains = Domain::pluck('domain', 'domain')->all();
            } else {
                $roles = Role::where('name', '!=', 'Super Admin')->where('name', '!=', 'Admin')->where('tenant_id', tenant('id'))->pluck('name', 'name');
                $domains = Domain::pluck('domain', 'domain')->all();
            }
            $domains = Domain::pluck('domain', 'domain')->all();
            $user_domain = Domain::where('tenant_id', $user->tenant_id)->first();
            $userRole = $user->roles->pluck('name', 'name')->all();
            return view('users.edit', compact('user', 'roles', 'domains', 'user_domain', 'userRole'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit-user')) {
            if (\Auth::user()->type == 'Super Admin') {
                $input = $request->all();
                $input['type'] = 'Admin';
                $user = User::find($id);
                $user->update($input);
                DB::table('model_has_roles')->where('model_id', $id)->delete();
                $user->assignRole('Admin');
                $domain = Domain::where('domain', $request->domains)->first();
                if ($domain) {
                    $user->tenant_id = $domain->tenant_id;
                    $user->update();
                } else {
                    $tenant = Tenant::create(['id' => $user->id]);
                    Domain::create([
                        'domain' => $request->domains,
                        'tenant_id' => $tenant->id
                    ]);
                    $user = User::find($user->id);
                    $user->tenant_id = $tenant->id;
                    $user->update();
                }
            } else {
                $this->validate($request, [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $id,
                    'roles' => 'required',
                ]);
                $input = $request->all();
                $input['type'] = $input['roles'];
                $user = User::find($id);
                $current_date = Carbon::now();
                $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($user->created_at)) . " + 1 year"));
                if ($current_date <= $newEndingDate) {
                }
                $user->update($input);
                DB::table('model_has_roles')->where('model_id', $id)->delete();
                $user->assignRole($request->input('roles'));
            }
            return redirect()->route('users.index')->with('success', __('User updated successfully'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function destroy($id)
    {
        if (\Auth::user()->can('delete-user')) {
            $user = User::find($id);
            $domain = Domain::where('tenant_id', $user->tenant_id)->first();
            $requestdomain = RequestDomain::where('email', $user->email)->first();
            if ($user->type == 'Admin') {
                if ($domain) {
                    $domain->delete();
                }
                if ($requestdomain) {
                    $requestdomain->delete();
                }
            }
            if ($user->id != 1) {
                $user->delete();
            }
            return redirect()->route('users.index')->with('success', __('User deleted successfully'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function impersonate($id)
    {
        // dd(\Auth::user());
        if (\Auth::user()->can('impersonate-user')) {
            $user = User::find($id);
            $current_domain = $user->tenant->domains->first()->domain;
            $redirectUrl = '/';
            $token = tenancy()->impersonate($user->tenant, $id, $redirectUrl);
            return redirect("http://$current_domain/impersonate/{$token->token}");
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }
    public function accountStatus($id)
    {
        $user = User::find($id);
        // dd($id);
        if($user->active_status == 1)
        {
            $user->active_status = 0;
            $user->save();
            return redirect()->back()->with('success','User Deactiveted Successfully');
        }
        else
        {
            $user->active_status = 1;
            $user->save();
            return redirect()->back()->with('success','User Activeted Successfully');
        }
    }
}

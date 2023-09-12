<?php

namespace App\Http\Controllers;

use App\DataTables\PlanDataTable;
use App\Models\Plan;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function index(PlanDataTable $dataTable)
    {
        if (\Auth::user()->can('manage-user')) {
            if (Auth::user()->type == 'Super Admin') {
                return $dataTable->render('plans.index');
            } else {
                $plans = Plan::all();
                $user = User::where('tenant_id', tenant('id'))->where('type', 'Admin')->first();
                return view('plans.index', compact('user', 'plans'));
            }
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function create()
    {
        if (\Auth::user()->can('create-plan')) {
            return view('plans.create');
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }


    public function store(Request $request)
    {
        // dd($request->all());
        if (\Auth::user()->can('create-plan')) {
            request()->validate([
                'name' => 'required',
                'price' => 'required',
                'duration' => 'required',
                'durationtype' => 'required',
                'max_users' => 'required',
            ]);
            Plan::create([
                'name' => $request->name,
                'price' => $request->price,
                'duration' => $request->duration,
                'durationtype' => $request->durationtype,

                'max_users' => $request->max_users,
            ]);
            return redirect()->route('plans.index')
                ->with('success', __('Plan Added successfully.'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function show(Plan $plan)
    {
        if (\Auth::user()->can('show-plan')) {

            $lan = Plan::find($plan);
            return view('plans.show', compact('plan'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function edit($id)
    {
        if (\Auth::user()->can('edit-plan')) {
            $plan = Plan::find($id);
            return view('plans.edit', compact('plan'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit-plan')) {
            request()->validate([
                'name' => 'required',
                'price' => 'required',
                'duration' => 'required',
                'max_users' => 'required',
            ]);
            $plan = Plan::find($id);
            $plan->name = $request->input('name');
            $plan->price = $request->input('price');
            $plan->duration = $request->input('duration');
            $plan->durationtype = $request->input('durationtype');
            $plan->max_users = $request->input('max_users');
            $plan->save();
            return redirect()->route('plans.index')
                ->with('success', __('Plan updated successfully'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function destroy($id)
    {
        if (\Auth::user()->can('delete-plan')) {
            $plan = Plan::find($id);
            if ($plan->id != 1) {
                $plan->delete();
                return redirect()->route('plans.index')
                    ->with('success', 'Plan deleted successfully');
            } else {
                return redirect()->back()->with('failed', __('Permission Denied.'));
            }
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }
}

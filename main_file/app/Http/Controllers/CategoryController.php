<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function index(CategoryDataTable $dataTable)
    {
        if (\Auth::user()->can('manage-category')) {
        return $dataTable->render('category.index');
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function create()
    {
       if (\Auth::user()->can('create-category')) {
        $category = Category::where('tenant_id',tenant('id'))->get();
        return view('category.create', compact('category'));
       } else {
           return redirect()->back()->with('failed', __('Permission Denied.'));
       }
    }

    public function store(Request $request)
    {
       if (\Auth::user()->can('create-category')) {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        Category::create([
            'name' => $request->name,
            'status' => $request->status
        ]);
       return redirect()->route('category.index')->with('success', __('Category Created Successfully'));
       } else {
           return redirect()->back()->with('failed', __('Permission Denied.'));
       }
    }

    public function edit($id)
    {
       if (\Auth::user()->can('edit-category')) {

        $category = Category::find($id);
        return view('category.edit', compact('category'));
       } else {
           return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit-category')) {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->status = $request->status;
        $category->update();
        return redirect()->route('category.index')->with('success', __('Category Updated Successfully'));
       } else {
           return redirect()->back()->with('failed', __('Permission Denied.'));
       }
    }

    public function destroy($id)
    {
        if (\Auth::user()->can('delete-category')) {

        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('success', __('Category Deleted Successfully'));
        } else {
           return redirect()->back()->with('failed', __('Permission Denied.'));
       }
    }
}

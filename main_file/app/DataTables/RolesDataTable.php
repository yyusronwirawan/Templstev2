<?php

namespace App\DataTables;

use App\Facades\UtilityFacades;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function (role $role) {
                return view('roles.action', compact('role'));
            })
            ->editColumn('created_at', function ($request) {
                return UtilityFacades::date_time_format($request->created_at);
            });
    }

    public function query(Role $model)
    {
        $user = Auth::user();
        if ($user->type == 'Super Admin') {
            return $model->newQuery()->whereNull('tenant_id');
        } else {
            return $model->newQuery()->where('tenant_id', tenant('id'));
        }
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->language([
                "paginate" => [
                    "next" => '<i class="ti ti-chevron-right"></i>',
                    "previous" => '<i class="ti ti-chevron-left"></i>'
                ]
            ])
            ->parameters([
                "dom" =>  "
                                <'row'<'col-sm-12'><'col-sm-9 text-left'B><'col-sm-3'f>>
                                <'row'<'col-sm-12'tr>>
                                <'row mt-3'<'col-sm-5'i><'col-sm-7'p>>
                                ",
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-primary btn-sm no-corner add_module', 'action' => " function ( e, dt, node, config ) {
                        window.location = '" . route('roles.create') . "';

                   }"],
                    ['extend' => 'export', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'pageLength', 'className' => 'btn btn-primary btn-sm no-corner',],
                ],

                "scrollX" => true
            ])->language([
                'buttons'=>[
                    'create'=>__('Create'),
                    'export'=>__('Export'),
                    'print'=>__('Print'),
                    'reset'=>__('Reset'),
                    'reload'=>__('Reload'),
                    'excel'=>__('Excel'),
                    'csv'=>__('CSV'),
                    'pageLength'=>__('Show %d rows'),
                ]
            ]);
    }

    protected function getColumns()
    {
        return [
            Column::make('No')->title(__('No'))->data('DT_RowIndex')->name('DT_RowIndex')->searchable(false)->orderable(false),
            Column::make('name')->title(__('Name')),
            Column::make('created_at')->title(__('Created At')),
            Column::computed('action')->title(__('Action'))
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center action-width')
                ->width('20%'),
        ];
    }

    protected function filename()
    {
        return 'Roles_' . date('YmdHis');
    }
}

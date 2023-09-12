<?php

namespace App\DataTables;

use App\Facades\UtilityFacades;
use App\Models\User;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_at', function ($request) {
                return UtilityFacades::date_time_format($request->created_at);
            })
            ->addColumn('role', function (User $user) {
                $out = '';
                if (!empty($user->getRoleNames())) {
                    foreach ($user->getRoleNames() as $v) {

                        $out = '<label class="custom-badge rounded-pill bg-primary">' . $v . '</label>';
                    }
                }
                return $out;
            })
            ->addColumn('action', function (User $user) {
                return view('users.action', compact('user'));
            })
            ->editColumn('domain', function (User $user) {
                return implode(", ",$user->tenant->domains->pluck('domain')->toArray());
            })
            ->rawColumns(['role', 'action']);
    }

    public function query(User $model)
    {
        if (tenant('id')==null) {
            return $model->newQuery()->where('type','Admin');
        } else {
            return $model->newQuery()->where('type','!=','Admin');
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
                               <'row'<'col-sm-12'><'col-sm-9 'B><'col-sm-3'f>>
                               <'row'<'col-sm-12'tr>>
                               <'row mt-3'<'col-sm-5'i><'col-sm-7'p>>
                               ",
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-primary btn-sm no-corner add_module', 'action' => " function ( e, dt, node, config ) {
                        window.location = '" . route('users.create') . "';

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
            Column::make('email')->title(__('email')),
            Column::make('role')->title(__('Role')),
            Column::make('domain')->title(__('Domain'))->searchable(false)->orderable(false),
            Column::make('created_at')->title(__('Created At')),
            Column::computed('action')->title(__('Action'))
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->width('20%'),
        ];
    }

    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}

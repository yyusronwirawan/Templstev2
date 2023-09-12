<?php

namespace App\DataTables;

use App\Facades\UtilityFacades;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SalesDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('expire_at', function (Order $order) {
                return Carbon::parse($order->orderUser->plan_expired_date)->format('d/m/Y');
            })
            ->editColumn('user_id', function (Order $order) {
                return $order->orderUser->name;
            })
            ->editColumn('plan_id', function (Order $order) {
                return $order->Plan->name;
            })
            ->editColumn('amount', function (Order $order) {
                return UtilityFacades::getsettings('currency_symbol').' '.$order->amount;
            })
            ->editColumn('status', function (Order $order) {
                if($order->status == 0 && $order->plan_id  == 1){
                    return '<span class="custom-badge rounded-pill rounded-pill bg-primary">'.__('Free').'</span>';
                }elseif($order->status ==2 &&  $order->plan_id  > 1){
                    return '<span class="custom-badge rounded-pill rounded-pill bg-danger">'.__('Cancel').'</span>';
                }elseif($order->status == 1 &&  $order->plan_id  > 1){
                    return '<span class="custom-badge rounded-pill rounded-pill bg-success">'.__('Success').'</span>';
                }else{
                    return '<span class="custom-badge rounded-pill rounded-pill bg-warning">'.__('Pedning').'</span>';
                }
            })


            // ->addColumn('action', function (order $order) {
            //     return view('sales.action', compact('order'));
            // })
            ->rawColumns(['amount','status']);
    }


    public function query(Order $model)
    {
         if (Auth::user()->type == 'Super Admin') {
            $form_values = Order::select(['orders.*', 'users.type'])->join('users', 'users.id', '=', 'orders.user_id');
            $form_values->where('users.type', '=', 'Admin');
        } else {
            $form_values = Order::select(['orders.*', 'users.type'])->join('users', 'users.id', '=', 'orders.user_id');
            $form_values->where('users.type', '!=', 'Admin');
        }
        return $form_values;
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
                    ['extend' => 'export', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'pageLength', 'className' => 'btn btn-primary btn-sm no-corner',],
                ],
                "scrollX" => true
            ])->language([
                'buttons' => [
                    'create' => __('Create'),
                    'export' => __('Export'),
                    'print' => __('Print'),
                    'reset' => __('Reset'),
                    'reload' => __('Reload'),
                    'excel' => __('Excel'),
                    'csv' => __('CSV'),
                    'pageLength' => __('Show %d rows'),
                ]
            ]);
    }

    protected function getColumns()
    {
        return [
            Column::make('No')->title(__('No'))->data('DT_RowIndex')->name('DT_RowIndex')->searchable(false)->orderable(false),
            Column::make('user_name')->title(__('User Name'))->data('user_id')->name('user_id'),
            Column::make('plan_name')->title(__('Plan Name'))->data('plan_id')->name('plan_id'),
            Column::make('amount')->title(__('Amount')),
            Column::make('status')->title(__('Status')),
            Column::make('expire_at')->title(__('Expire At'))->searchable(false)->orderable(false),
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center')
            //     ->width('20%'),
        ];
    }

    protected function filename()
    {
        return 'Sale_' . date('YmdHis');
    }
}

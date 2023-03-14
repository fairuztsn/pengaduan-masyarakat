<?php

namespace App\DataTables;

use App\Models\Tanggapan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TanggapanDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return Auth::user()->role_id != 1 ? (new EloquentDataTable($query))
            ->addColumn('action', function($query) {
                $csrf_token = csrf_token();
                $action = route("tanggapan.archive", $query->id);
                $route = route("tanggapan.detail", $query->id);                
                
                return Auth::user()->role_id == 3 ? <<<html
                <div class="d-flex">
                <a href="$route" class="btn btn-dark me-2"><i class="fas fa-eye"></i></a>
                <form action="$action" method="POST">
                    <input type="hidden" name="_token" value="$csrf_token" />
                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </form>
                </div>
                
                html : <<<html
                <div class="d-flex">
                <a href="$route" class="btn btn-dark me-2"><i class="fas fa-eye"></i></a>
                </div>
                html;
            })->editColumn("nama_user", function($query) {
                return $query->user->nama;
            })->filterColumn("nama_user", function($query, $keyword) {
                // idk
                $query->where("id_user", \App\Models\User::where("nama", "LIKE", "%".$keyword."%")->first()->id ?? 0);
            })->orderColumn("nama_user", false)
            ->setRowId('id') : 
            (new EloquentDataTable($query))
            ->addColumn('action', function($query) {
                $csrf_token = csrf_token();
                $action = route("tanggapan.archive", $query->id);
                $route = route("tanggapan.detail", $query->id);                
                
                return <<<html
                <div class="d-flex">
                <a href="$route" class="btn btn-dark me-2"><i class="fas fa-eye"></i></a>
                </div>
                html;
            })->editColumn("nama_user", function($query) {
                return $query->user->nama;
            })->filterColumn("nama_user", function($query, $keyword) {
                // idk
                $query->where("id_user", \App\Models\User::where("nama", "LIKE", "%".$keyword."%")->first()->id ?? 0);
            })->orderColumn("nama_user", false)
            ->editColumn("judul_laporan", function($query) {
                return $query->laporan->judul;
            })->filterColumn("judul_laporan", function($query, $keyword) {
                $query->where("id_laporan", \App\Models\Laporan::where("judul", "LIKE", "%".$keyword."%")->first()->id ?? 0);
            })->orderColumn("judul_laporan", false)->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Tanggapan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Tanggapan $model): QueryBuilder
    {
        return Auth::user()->role_id != 1 ? $model->whereHas("laporan", function($query) {
            $query->whereNull("deleted_at");
        })->whereNull("deleted_at") : $model->whereHas("laporan", function($query) {
            $query->where("id_user", Auth::id())->whereNull("deleted_at");
        })->whereNull("deleted_at");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('tanggapan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return Auth::user()->role_id != 1 ? [
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
            Column::make('id'),
            Column::make('id_laporan'),
            Column::make("tanggapan"),
            Column::make("id_user"),
            Column::make("nama_user"),
            Column::make('created_at'),
        ] : [
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
            Column::make('id'),
            Column::make("judul_laporan"),
            Column::make("tanggapan"),
            Column::make("nama_user"),
            Column::make('created_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Tanggapan_' . date('YmdHis');
    }
}
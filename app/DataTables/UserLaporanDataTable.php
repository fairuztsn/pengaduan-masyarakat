<?php

namespace App\DataTables;

use App\Models\Laporan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserLaporanDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query) {
                $route = route("laporan.detail", $query->id);
                $action = route("laporan.archive", $query->id);
                $csrf_token = csrf_token();
                return <<<html
                <div class="d-flex">
                <a href="$route" class="btn btn-dark me-2"><i class="fas fa-eye"></i></a>
                </div>
                html;
            })->editColumn("foto", function($query) {
                $url = "/storage/foto_laporan/$query->foto";

                return <<<html
                <a href="$url" class="link-dark" target="_blank">$query->foto</a>
                html;
            })
            ->rawColumns(["foto", "action"])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Laporan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Laporan $model): QueryBuilder
    {
        // No need uid
        return $model->whereNull("deleted_at")->where("id_user", Auth::id());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('laporan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        
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
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make("judul"),
            Column::make("tanggal_kejadian"),
            Column::make("foto"),
            Column::make('status'),
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
        return 'Laporan_' . date('YmdHis');
    }
}

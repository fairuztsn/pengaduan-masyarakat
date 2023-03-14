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



class LaporanDataTable extends DataTable
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

                return Auth::user()->role_id == 3 ? <<<html
                <div class="d-flex">
                <a href="$route" class="btn btn-dark me-2"><i class="fas fa-eye"></i></a>
                <form action="$action" method="POST">
                    <input type="hidden" name="_token" value="$csrf_token" />
                    <input type="hidden" name="id" value="$query->id"/>
                    <input type="hidden" name="returns" value="view"/>
                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </form>
                </div>
                html : <<<html
                <div class="d-flex">
                <a href="$route" class="btn btn-dark me-2"><i class="fas fa-eye"></i></a>
                </div>
                html;
            })->editColumn("foto", function($query) {
                $url = "/storage/foto_laporan/$query->foto";

                return <<<html
                <a href="$url" class="link-dark" target="_blank">$query->foto</a>
                html;
            })->editColumn("nama_user", function($query) {
                return $query->user->nama;
                // return \App\Models\User::where("nama", "LIKE", "%Lu%")->first()->id;
            })->filterColumn("nama_user", function($query, $keyword) {
                // idk
                $query->where("id_user", \App\Models\User::where("nama", "LIKE", "%".$keyword."%")->first()->id ?? 1);
            })->orderColumn("nama_user", false)
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
        return $model->whereNull("deleted_at");
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
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make("judul"),
            Column::make("tanggal_kejadian"),
            Column::make("id_user"),
            Column::make("nama_user"),
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

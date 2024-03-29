<?php

namespace App\DataTables;

use App\Models\Tanggapan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Http\Request;

class TanggapanArchivedDataTable extends DataTable
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
            $csrf_token = csrf_token();
            $action = route("tanggapan.unarchive", $query->id);
            $route = route("archived.tanggapan.detail", $query->id);                
            
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
        ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TanggapanArchived $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Tanggapan $model, Request $request): QueryBuilder
    {
        if($request->has("uid")) {
            $model = $model->where("id_user", $request->uid);
        }
        return $model->whereNotNull("deleted_at");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('tanggapanarchived-table')
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
                  Column::make('id_laporan'),
                  Column::make("tanggapan"),
                  Column::make("id_user"),
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
        return 'TanggapanArchived_' . date('YmdHis');
    }
}

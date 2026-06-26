<?php

namespace App\DataTables;

use App\Models\Struktur;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StrukturDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Struktur> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('url_struktur', function ($item) {
                if ($item->url_struktur) {
                    $url = Storage::disk('public')->url($item->url_struktur);
                    return '<a href="' . $url . '" target="_blank">
                                <img src="' . $url . '" alt="Struktur Organisasi"
                                     class="rounded border shadow-sm"
                                     style="max-width:120px; max-height:80px; object-fit:contain;">
                            </a>';
                }
                return '<span class="text-muted fst-italic">-</span>';
            })
            ->addColumn('action', function ($struktur) {
                $btn = '<div class="d-flex justify-content-center align-items-center" style="gap: 5px;">';
                $btn .= '<a href="' . route('struktur.edit', $struktur->id) . '" class="btn btn-sm btn-warning text-white rounded shadow-sm d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;" title="Edit"><i class="fa-solid fa-pen-to-square" style="font-size: 11px;"></i></a>';
                $btn .= '<form action="' . route('struktur.destroy', $struktur->id) . '" method="POST" class="m-0">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm rounded shadow-sm d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;" title="Hapus" onclick="return confirm(\'Yakin ingin menghapus data ini?\')"><i class="fa-solid fa-trash-can" style="font-size: 11px;"></i></button></form>';
                $btn .= '</div>';

                return $btn;
            })
            ->setRowId('DT_RowIndex')
            ->rawColumns(['action', 'url_struktur']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Struktur>
     */
    public function query(Struktur $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('struktur-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload'),
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->title('NO')
                ->width('5%')
                ->addClass('text-center')
                ->searchable(false)
                ->orderable(false),
            Column::make('url_struktur')
                ->title('Gambar Struktur')
                ->addClass('text-center')
                ->searchable(false)
                ->orderable(false),
            Column::computed('action')
                ->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->width('10%'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Struktur_' . date('YmdHis');
    }
}

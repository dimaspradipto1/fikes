<?php

namespace App\DataTables;

use App\Models\VisiMisi;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VisiMisiDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<VisiMisi> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('visi', function ($item) {
                return $item->visi
                    ? '<span title="' . e(strip_tags($item->visi)) . '">' . Str::limit(strip_tags($item->visi), 80) . '</span>'
                    : '<span class="text-muted fst-italic">-</span>';
            })
            ->addColumn('misi', function ($item) {
                return $item->misi
                    ? '<span title="' . e(strip_tags($item->misi)) . '">' . Str::limit(strip_tags($item->misi), 80) . '</span>'
                    : '<span class="text-muted fst-italic">-</span>';
            })
            ->addColumn('tujuan', function ($item) {
                return $item->tujuan
                    ? '<span title="' . e(strip_tags($item->tujuan)) . '">' . Str::limit(strip_tags($item->tujuan), 80) . '</span>'
                    : '<span class="text-muted fst-italic">-</span>';
            })
            ->addColumn('action', function ($visiMisi) {
                $btn = '<div class="d-flex justify-content-center align-items-center" style="gap: 5px;">';
                $btn .= '<a href="' . route('visi-misi.edit', $visiMisi->id) . '" class="btn btn-sm btn-warning text-white rounded shadow-sm d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;" title="Edit"><i class="fa-solid fa-pen-to-square" style="font-size: 11px;"></i></a>';
                $btn .= '<form action="' . route('visi-misi.destroy', $visiMisi->id) . '" method="POST" class="m-0">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm rounded shadow-sm d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;" title="Hapus" onclick="return confirm(\'Yakin ingin menghapus data ini?\')"><i class="fa-solid fa-trash-can" style="font-size: 11px;"></i></button></form>';
                $btn .= '</div>';

                return $btn;
            })
            ->setRowId('DT_RowIndex')
            ->rawColumns(['action', 'visi', 'misi', 'tujuan']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<VisiMisi>
     */
    public function query(VisiMisi $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('visimisi-table')
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
            Column::make('visi')
                ->title('Visi'),
            Column::make('misi')
                ->title('Misi'),
            Column::make('tujuan')
                ->title('Tujuan'),
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
        return 'VisiMisi_' . date('YmdHis');
    }
}

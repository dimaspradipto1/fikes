<?php

namespace App\DataTables;

use App\Models\Kontak;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class KontakDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Kontak> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('no_telp', function ($item) {
                return $item->no_telp ?? '<span class="text-muted fst-italic">-</span>';
            })
            ->addColumn('email', function ($item) {
                return $item->email ?? '<span class="text-muted fst-italic">-</span>';
            })
            ->addColumn('alamat', function ($item) {
                return $item->alamat
                    ? '<span title="' . e($item->alamat) . '">' . \Str::limit($item->alamat, 60) . '</span>'
                    : '<span class="text-muted fst-italic">-</span>';
            })
            ->addColumn('koordinat', function ($item) {
                if ($item->latitude && $item->longitude) {
                    return '<span class="badge bg-info text-dark">'
                        . e($item->latitude) . ', ' . e($item->longitude)
                        . '</span>';
                }
                return '<span class="text-muted fst-italic">-</span>';
            })
            ->addColumn('action', function ($kontak) {
                $btn = '<div class="d-flex justify-content-center align-items-center" style="gap: 5px;">';
                $btn .= '<a href="' . route('kontak.edit', $kontak->id) . '" class="btn btn-sm btn-warning text-white rounded shadow-sm d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;" title="Edit"><i class="fa-solid fa-pen-to-square" style="font-size: 11px;"></i></a>';
                $btn .= '<form action="' . route('kontak.destroy', $kontak->id) . '" method="POST" class="m-0">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm rounded shadow-sm d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;" title="Hapus" onclick="return confirm(\'Yakin ingin menghapus data ini?\')"><i class="fa-solid fa-trash-can" style="font-size: 11px;"></i></button></form>';
                $btn .= '</div>';

                return $btn;
            })
            ->setRowId('DT_RowIndex')
            ->rawColumns(['action', 'alamat', 'koordinat', 'no_telp', 'email']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Kontak>
     */
    public function query(Kontak $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('kontak-table')
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
            Column::make('no_telp')
                ->title('No. Telepon'),
            Column::make('email')
                ->title('Email'),
            Column::make('alamat')
                ->title('Alamat'),
            Column::make('koordinat')
                ->title('Koordinat')
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
        return 'Kontak_' . date('YmdHis');
    }
}

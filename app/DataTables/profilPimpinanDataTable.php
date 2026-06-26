<?php

namespace App\DataTables;

use App\Models\ProfilPimpinan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProfilPimpinanDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<ProfilPimpinan> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('url_photo', function ($item) {
                if ($item->url_photo) {
                    $url = Storage::disk('public')->url($item->url_photo);
                    return '<img src="' . $url . '" alt="Foto ' . e($item->nama) . '"
                                 class="rounded-circle border shadow-sm"
                                 style="width:50px;height:50px;object-fit:cover;">';
                }
                return '<div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center"
                              style="width:50px;height:50px;">
                            <i class="bi bi-person-fill text-white fs-5"></i>
                        </div>';
            })
            ->addColumn('action', function ($profilPimpinan) {
                $btn = '<div class="d-flex justify-content-center align-items-center" style="gap: 5px;">';
                $btn .= '<a href="' . route('profil-pimpinan.edit', $profilPimpinan->id) . '" class="btn btn-sm btn-warning text-white rounded shadow-sm d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;" title="Edit"><i class="fa-solid fa-pen-to-square" style="font-size: 11px;"></i></a>';
                $btn .= '<form action="' . route('profil-pimpinan.destroy', $profilPimpinan->id) . '" method="POST" class="m-0">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm rounded shadow-sm d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;" title="Hapus" onclick="return confirm(\'Yakin ingin menghapus data ini?\')"><i class="fa-solid fa-trash-can" style="font-size: 11px;"></i></button></form>';
                $btn .= '</div>';

                return $btn;
            })
            ->setRowId('DT_RowIndex')
            ->rawColumns(['action', 'url_photo']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<ProfilPimpinan>
     */
    public function query(ProfilPimpinan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('profilpimpinan-table')
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
            Column::make('url_photo')
                ->title('Foto')
                ->addClass('text-center')
                ->searchable(false)
                ->orderable(false),
            Column::make('nama')
                ->title('Nama'),
            Column::make('jabatan')
                ->title('Jabatan'),
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
        return 'ProfilPimpinan_' . date('YmdHis');
    }
}

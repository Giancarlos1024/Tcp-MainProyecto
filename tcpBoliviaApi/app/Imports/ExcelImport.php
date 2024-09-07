<?php

namespace App\Imports;

use App\Models\ExcelDBRegistro;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ExcelImport implements ToCollection
{
    use Importable;

    public function collection(Collection $collection)
    {
        // Ignorar la primera fila que contiene los encabezados
        $rows = $collection->skip(1);
    
        foreach ($rows as $row) {
            // Debug: Imprimir la fila para verificar su estructura
            if (count($row) !== 17) {
                // Si el número de columnas no es el esperado
                \Log::error('Número incorrecto de columnas en la fila: ' . json_encode($row));
                continue; // Saltar esta fila
            }
    
            ExcelDBRegistro::create([
                'numres2'         => $row[0] ?? null,
                'res_fecha' => isset($row[1]) && !empty($row[1]) ? \Carbon\Carbon::parse(Date::excelToDateTimeObject($row[1]))->format('Y-m-d') : null,
                'res_tipo'        => $row[2] ?? null,
                'res_tipo2'       => $row[3] ?? null,
                'res_fondo_voto' => $row[4] ?? null,
                'resresul'        => $row[5] ?? null,
                'revresul'        => $row[6] ?? null,
                'resfinal'        => $row[7] ?? null,
                'relator'         => $row[8] ?? null,
                'restiempo'       => $row[9] ?? null,
                'caso_id'         => $row[10] ?? null,
                'sala'            => $row[11] ?? null,
                'accion_const'    => $row[12] ?? null,
                'accion_const2'   => $row[13] ?? null,
                'res_emisor'      => $row[14] ?? null,
                'departamento_id' => $row[15] ?? null,
                'municipio_id'    => $row[16] ?? null,
                'fecha_ingreso'   => isset($row[17]) && !empty($row[17]) ? Date::excelToDateTimeObject($row[17]) : null,
            ]);
        }
    }
    
}

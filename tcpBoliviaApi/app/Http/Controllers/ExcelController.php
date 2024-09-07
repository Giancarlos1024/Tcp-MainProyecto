<?php

// app/Http/Controllers/ExcelController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use App\Models\ExcelDBRegistro; // Asegúrate de que el nombre del modelo sea correcto

class ExcelController extends Controller
{
    public function upload(Request $request)
    {

        dd($request->all());
        // Validar el archivo recibido, permitiendo CSV y Excel
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls|max:20480', // Permite CSV y Excel
        ]);
    
        $file = $request->file('file');
    
        // Depuración del tipo MIME
        dd($file->getMimeType());
    
        if (!$file) {
            return response()->json(['error' => 'No se ha recibido ningún archivo.'], 422);
        }
    
        if (!$file->isValid()) {
            return response()->json(['error' => 'El archivo subido no es válido.'], 422);
        }
    
        try {
            // Procesar el archivo según tu lógica
            // Aceptar tanto archivos CSV como Excel
            if ($file->getClientOriginalExtension() == 'csv') {
                Excel::import(new ExcelImport, $file);
            } elseif (in_array($file->getClientOriginalExtension(), ['xlsx', 'xls'])) {
                Excel::import(new ExcelImport, $file);
            } else {
                return response()->json(['error' => 'Tipo de archivo no permitido.'], 422);
            }
    
            return response()->json(['message' => 'Archivo cargado y datos insertados exitosamente.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al procesar el archivo: ' . $e->getMessage()], 422);
        }
    }
}

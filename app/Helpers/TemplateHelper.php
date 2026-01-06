<?php

namespace App\Helpers;

class TemplateHelper
{
    // public static function render(string $template, array $data = []): string
    // {
    //     foreach ($data as $key => $value) {
    //         $template = str_replace('{{' . $key . '}}', $value, $template);
    //     }
    //     return $template;
    // }

    public static function render($template, $data)
    {
        // 1. Jika template kosong, kembalikan string kosong
        if (empty($template)) {
            return '';
        }

        // 2. Cari semua pattern {{ variable }} menggunakan Regex
        // Pattern: /\{\{\s*([a-zA-Z0-9_]+)\s*\}\}/
        // Artinya: Cari kurung kurawal ganda, ambil teks di tengahnya (variable)
        
        return preg_replace_callback('/\{\{\s*([a-zA-Z0-9_]+)\s*\}\}/', function ($matches) use ($data) {
            $key = $matches[1]; // Ini nama variablenya, misal: 'nama_pemohon'

            // Cek apakah key tersebut ada di dalam array data
            if (isset($data[$key])) {
                return $data[$key];
            }

            // Jika data tidak ditemukan, biarkan kosong atau tulis tanda merah (opsional)
            return ''; 
        }, $template);
    }
}
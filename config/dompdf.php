<?php

return [
    'font_path' => base_path(), // Lokasi font
    'font_cache' => storage_path('app/dompdf/fontcache/'), // Cache font
    'default_font' => 'PublicSans',
    'enable_php' => true,
    'pdf_backend' => 'cpdf',
    'default_paper_size' => 'A4',
];

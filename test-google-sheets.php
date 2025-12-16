<?php

require __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\GoogleSheetsService;

// Test Google Sheets connection
try {
    echo "Testing Google Sheets connection...\n\n";
    
    $googleSheets = new GoogleSheetsService();
    echo "✓ GoogleSheetsService initialized\n";
    
    $stt = $googleSheets->getNextSTT();
    echo "✓ Current STT: $stt\n";
    
    $result = $googleSheets->appendData([
        'stt' => $stt,
        'name' => 'Test User',
        'khoi' => '9',
        'bode' => 'toan',
        'phone' => '0123456789',
        'email' => 'test@example.com',
        'tham_gia_chua' => '',
        'group_link' => 'https://zalo.me/g/wnvnikf40'
    ]);
    
    if ($result['success']) {
        echo "✓ Data appended successfully!\n";
        echo "  Updated cells: " . $result['updatedCells'] . "\n";
    } else {
        echo "✗ Error: " . $result['error'] . "\n";
    }
    
} catch (\Exception $e) {
    echo "✗ Exception: " . $e->getMessage() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString() . "\n";
}

<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;

class GoogleSheetsService
{
    private $client;
    private $service;
    private $spreadsheetId;

    public function __construct()
    {
        $this->spreadsheetId = '1-bA8gpCF3OUh3gpgVO-tqV3OZU0s7uDtQ63Xa-ppWdI';
        
        $this->client = new Client();
        $this->client->setApplicationName('Nova Luyende');
        $this->client->setScopes([Sheets::SPREADSHEETS]);
        $this->client->setAuthConfig(storage_path('app/google-credentials.json'));
        $this->client->setAccessType('offline');
        
        $this->service = new Sheets($this->client);
    }

    /**
     * Thêm dữ liệu mới vào Google Sheets
     */
    public function appendData($data)
    {
        try {
            $range = 'Sheet1!A:H'; // Tên sheet mặc định
            
            $values = [
                [
                    $data['stt'] ?? '',
                    $data['name'] ?? '',
                    $data['khoi'] ?? '',
                    $data['bode'] ?? '',
                    $data['phone'] ?? '',
                    $data['email'] ?? '',
                    $data['tham_gia_chua'] ?? '',
                    $data['group_link'] ?? ''
                ]
            ];
            
            $body = new \Google\Service\Sheets\ValueRange([
                'values' => $values
            ]);
            
            $params = [
                'valueInputOption' => 'RAW'
            ];
            
            $result = $this->service->spreadsheets_values->append(
                $this->spreadsheetId,
                $range,
                $body,
                $params
            );
            
            return [
                'success' => true,
                'updatedCells' => $result->getUpdates()->getUpdatedCells()
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Lấy số thứ tự tiếp theo
     */
    public function getNextSTT()
    {
        try {
            $range = 'Sheet1!A:A';
            $response = $this->service->spreadsheets_values->get($this->spreadsheetId, $range);
            $values = $response->getValues();
            
            if (empty($values)) {
                return 1;
            }
            
            // Đếm số dòng (trừ header)
            return count($values);
        } catch (\Exception $e) {
            return 1;
        }
    }
}

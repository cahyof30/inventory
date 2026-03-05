<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class GoogleSheetService
{
    protected Sheets $service;

    protected string $spreadsheetId;

    public function __construct()
    {
        $client = new Client;
        $client->setAuthConfig(storage_path('app/google/service-account.json'));
        $client->addScope(Sheets::SPREADSHEETS);

        $this->service = new Sheets($client);
        $this->spreadsheetId = '1vgGygJg_hZEpdyPqL4TENB9ghxj1_OS7bgT-T8QIkI0';
    }

    public function updateRowById(string $code, array $data): void
    {
        $response = $this->service->spreadsheets_values->get($this->spreadsheetId, 'Sheet1!A:A');
        $rows = $response->getValues();

        if ($rows) {
            foreach ($rows as $index => $row) {
                if (isset($row[0]) && $row[0] === $code) {
                    $rowNumber = $index + 1;
                    $body = new ValueRange(['values' => [array_values($data)]]);

                    $this->service->spreadsheets_values->update(
                        $this->spreadsheetId,
                        "Sheet1!A{$rowNumber}",
                        $body,
                        ['valueInputOption' => 'RAW']
                    );

                    return; // Keluar jika sudah update
                }
            }
        }

        // Jika tidak ditemukan di loop atas, maka TAMBAH BARU
        $this->appendRows([$data]);
    }

    public function appendRows(array $multipleData): void
    {
         if (count($multipleData) === count($multipleData, COUNT_RECURSIVE)) {
        $multipleData = [$multipleData];
    }

    // Hilangkan semua key dan paksa menjadi array numerik murni
    $formattedValues = [];
    foreach ($multipleData as $row) {
        $formattedValues[] = array_values((array) $row);
    }

    $body = new \Google\Service\Sheets\ValueRange([
        'values' => $formattedValues
    ]);

    $params = [
        'valueInputOption' => 'RAW',
        'insertDataOption' => 'INSERT_ROWS'
    ];

    $this->service->spreadsheets_values->append(
        $this->spreadsheetId,
        'Sheet1!A1',
        $body,
        $params
    );
    }

    public function deleteRowById(string $code): void
    {
        $response = $this->service->spreadsheets_values->get(
            $this->spreadsheetId,
            'Sheet1!A:A'
        );

        $rows = $response->getValues();

        if (! $rows) {
            return;
        }

        foreach ($rows as $index => $row) {
            if ($row[0] === $code) {

                $requests = [
                    new \Google\Service\Sheets\Request([
                        'deleteDimension' => [
                            'range' => [
                                'sheetId' => 0, // biasanya 0 untuk sheet pertama
                                'dimension' => 'ROWS',
                                'startIndex' => $index,
                                'endIndex' => $index + 1,
                            ],
                        ],
                    ]),
                ];

                $batchUpdateRequest = new \Google\Service\Sheets\BatchUpdateSpreadsheetRequest([
                    'requests' => $requests,
                ]);

                $this->service->spreadsheets->batchUpdate(
                    $this->spreadsheetId,
                    $batchUpdateRequest
                );

                break;
            }
        }
    }
}

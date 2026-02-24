<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;

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
        // $this->spreadsheetId = env('GOOGLE_SHEET_ID');
        $this->spreadsheetId = '1vgGygJg_hZEpdyPqL4TENB9ghxj1_OS7bgT-T8QIkI0';
    }

    public function appendRow(array $data): void
    {
        $client = $this->service->getClient();

        $url = "https://sheets.googleapis.com/v4/spreadsheets/{$this->spreadsheetId}/values/Sheet1!A1:append?valueInputOption=RAW";

        $body = [
            'values' => [
                array_values($data),
            ],
        ];

        $request = new \GuzzleHttp\Psr7\Request(
            'POST',
            $url,
            ['Content-Type' => 'application/json'],
            json_encode($body)
        );

        $client->authorize()->send($request);
    }

    public function updateRowById(string $code, array $data): void
    {
        // Ambil semua data kolom A (ID)
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

                $rowNumber = $index + 1; // karena sheet mulai dari 1

                $body = new \Google\Service\Sheets\ValueRange;
                $body->setValues([array_values($data)]);

                $this->service->spreadsheets_values->update(
                    $this->spreadsheetId,
                    "Sheet1!A{$rowNumber}",
                    $body,
                    ['valueInputOption' => 'RAW']
                );

                break;
            }
        }
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

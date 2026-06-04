<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
use Illuminate\Support\Str;

class GenerateItemUuid extends Command
{
    // PASTIKAN baris ini sama persis dengan yang Anda panggil di terminal
    protected $signature = 'items:generate-uuid';

    protected $description = 'Generate UUID untuk item lama yang masih NULL';

    public function handle()
    {
        $count = 0;

        // Menggunakan chunkById agar tidak terjadi infinite loop
        Item::whereNull('public_uuid')
            ->chunkById(100, function ($items) use (&$count) {
                foreach ($items as $item) {
                    $item->update([
                        'public_uuid' => (string) Str::uuid(),
                    ]);
                    $count++;
                }
            });

        $this->info("Selesai! {$count} item berhasil diperbarui.");
    }
}
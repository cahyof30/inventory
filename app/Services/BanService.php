<?php

use App\Models\IpBan;

class BanService
{
    public static function isBanned($ip)
    {
        return IpBan::where('ip', $ip)
            ->where('banned_until', '>', now())
            ->exists();
    }

    public static function failed($ip)
    {
        $ban = IpBan::firstOrCreate(
            ['ip'=>$ip]
        );

        $ban->increment('failed_attempts');

        if ($ban->failed_attempts >= 5) {

            $ban->update([
                'failed_attempts'=>0,
                'banned_until'=>now()->addHour(),
            ]);
        }
    }

    public static function success($ip)
    {
        IpBan::where('ip',$ip)
            ->update([
                'failed_attempts'=>0,
                'banned_until'=>null,
            ]);
    }
}
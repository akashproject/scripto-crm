<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimezoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timeZones = [
            [
                "name" => "(GMT-11:00) Midway Island",
                "value" => "Pacific/Midway"
            ],
            [
                "name" => "(GMT-10:00) Hawaii",
                "value" => "Pacific/Honolulu"
            ],
            [
                "name" => "(GMT-09:00) Alaska",
                "value" => "America/Anchorage"
            ],
            [
                "name" => "(GMT-08:00) Pacific Time (US & Canada)",
                "value" => "America/Los_Angeles"
            ],
            [
                "name" => "(GMT-07:00) Mountain Time (US & Canada)",
                "value" => "America/Denver"
            ],
            [
                "name" => "(GMT-06:00) Central Time (US & Canada)",
                "value" => "America/Chicago"
            ],
            [
                "name" => "(GMT-05:00) Eastern Time (US & Canada)",
                "value" => "America/New_York"
            ],
            [
                "name" => "(GMT-04:30) Caracas",
                "value" => "America/Caracas"
            ],
            [
                "name" => "(GMT-04:00) Atlantic Time (Canada)",
                "value" => "America/Halifax"
            ],
            [
                "name" => "(GMT-03:00) Brasília",
                "value" => "America/Sao_Paulo"
            ],
            [
                "name" => "(GMT-02:00) Mid-Atlantic",
                "value" => "Atlantic/South_Georgia"
            ],
            [
                "name" => "(GMT-01:00) Azores",
                "value" => "Atlantic/Azores"
            ],
            [
                "name" => "(GMT+00:00) Greenwich Mean Time",
                "value" => "Europe/London"
            ],
            [
                "name" => "(GMT+01:00) Central European Time",
                "value" => "Europe/Berlin"
            ],
            [
                "name" => "(GMT+02:00) Eastern European Time",
                "value" => "Europe/Athens"
            ],
            [
                "name" => "(GMT+04:00) Dubai",
                "value" => "Asia/Dubai"
            ],
            [
                "name" => "(GMT+05:30) India Standard Time",
                "value" => "Asia/Kolkata"
            ],
            [
                "name" => "(GMT+07:00) Bangkok",
                "value" => "Asia/Bangkok"
            ],
            [
                "name" => "(GMT+08:00) Hong Kong",
                "value" => "Asia/Hong_Kong"
            ],
            [
                "name" => "(GMT+09:00) Tokyo",
                "value" => "Asia/Tokyo"
            ],
            [
                "name" => "(GMT+10:00) Sydney",
                "value" => "Australia/Sydney"
            ],
            [
                "name" => "(GMT+12:00) Auckland",
                "value" => "Pacific/Auckland"
            ]
        ];

        DB::table('timezone')->insert($timeZones);
    }
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImpressionController extends Controller
{
    public function store(Request $request)
    {
        $logPath = storage_path('logs/daily-impressions.log');
        $today = now()->format('Y-m-d');

        // Read and parse existing log file
        $lines = File::exists($logPath) ? explode("\n", trim(File::get($logPath))) : [];

        $data = collect($lines)->mapWithKeys(function ($line) {
            [$date, $count] = explode(': ', $line);
            return [$date => (int) $count];
        });

        // Increment today's count
        $data[$today] = isset($data[$today]) ? $data[$today] + 1 : 1;

        // Save log back
        $content = $data->map(fn($count, $date) => "$date: $count")->implode("\n");
        File::put($logPath, $content);

        return response()->json(['status' => 'ok']);
    }
}
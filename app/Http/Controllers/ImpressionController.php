<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImpressionController extends Controller
{
    public function store(Request $request)
    {
        \Log::info('🎯 ImpressionController hit');

        $logPath = storage_path('logs/daily-impressions.log');
        $today = now()->format('Y-m-d');

        \Log::info("📅 Today is: $today");
        \Log::info("📄 Log file path: $logPath");

        try {
            $lines = \File::exists($logPath) ? explode("\n", trim(\File::get($logPath))) : [];

            // Safely parse lines
            $data = collect($lines)->filter(function ($line) {
                return str_contains($line, ': ');
            })->mapWithKeys(function ($line) {
                [$date, $count] = explode(': ', $line, 2); // safe split
                return [$date => (int) $count];
            });

            \Log::info('📊 Parsed existing data:', $data->toArray());

            // Update today's count
            $data[$today] = isset($data[$today]) ? $data[$today] + 1 : 1;

            \Log::info("✅ Updated count for $today: " . $data[$today]);

            // Save
            $content = $data->map(fn($count, $date) => "$date: $count")->implode("\n");
            \File::put($logPath, $content);

            \Log::info('💾 Log file updated successfully');
            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            \Log::error('❌ Error in ImpressionController: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
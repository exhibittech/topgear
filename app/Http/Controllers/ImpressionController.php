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
        $action = $request->input('action', 'impression'); // default to impression

        try {
            // Read log file safely
            $lines = \File::exists($logPath) ? explode("\n", trim(\File::get($logPath))) : [];

            $data = collect($lines)->filter(function ($line) {
                return str_contains($line, ':');
            })->mapWithKeys(function ($line) {
                [$date, $rest] = explode(': ', $line, 2);
                [$impressions, $clicks] = explode(' | ', $rest . ' | 0'); // fallback click = 0
                return [$date => [
                    'impressions' => (int) $impressions,
                    'clicks' => (int) $clicks,
                ]];
            });

            // Initialize or update count
            $current = $data[$today] ?? ['impressions' => 0, 'clicks' => 0];
            if ($action === 'click') {
                $current['clicks'] += 1;
                \Log::info("🖱️ Click added for $today. Total now: " . $current['clicks']);
            } else {
                $current['impressions'] += 1;
                \Log::info("👁️ Impression added for $today. Total now: " . $current['impressions']);
            }

            $data[$today] = $current;

            // Rebuild log content
            $content = $data->map(function ($counts, $date) {
                return "$date: {$counts['impressions']} | {$counts['clicks']}";
            })->implode("\n");

            \File::put($logPath, $content);
            \Log::info("✅ Log updated: $today = {$current['impressions']} | {$current['clicks']}");

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            \Log::error('❌ Error in ImpressionController: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
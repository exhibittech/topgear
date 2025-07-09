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
        $action = $request->input('action', 'impression');

        try {
            $lines = \File::exists($logPath) ? explode("\n", trim(\File::get($logPath))) : [];

            // Build array (not collection) to avoid mutation issue
            $data = collect($lines)->filter(fn($line) => str_contains($line, ':'))
                ->mapWithKeys(function ($line) {
                    [$date, $rest] = explode(': ', $line, 2);
                    [$imp, $click] = array_pad(explode(' | ', $rest), 2, 0);
                    return [$date => [
                        'impressions' => (int) $imp,
                        'clicks' => (int) $click,
                    ]];
                })->toArray(); // ✅ Convert to regular PHP array

            // Safely update today's data
            $todayData = $data[$today] ?? ['impressions' => 0, 'clicks' => 0];

            if ($action === 'click') {
                $todayData['clicks'] += 1;
                \Log::info("🖱️ Click counted for $today: " . $todayData['clicks']);
            } else {
                $todayData['impressions'] += 1;
                \Log::info("👁️ Impression counted for $today: " . $todayData['impressions']);
            }

            $data[$today] = $todayData;

            // Write back to log
            $content = collect($data)->map(fn($counts, $date) =>
                "$date: {$counts['impressions']} | {$counts['clicks']}"
            )->implode("\n");

            \File::put($logPath, $content);
            \Log::info("✅ Log updated for $today");

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            \Log::error('❌ Error in ImpressionController: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
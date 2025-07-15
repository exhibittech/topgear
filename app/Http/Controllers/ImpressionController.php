<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImpressionController extends Controller
{
    public function store(Request $request)
    {
        \Log::info('🎯 ImpressionController hit');

        $logPath = app_path('track/daily-impressions.txt'); // Changed .log to .txt
        $today = now()->format('Y-m-d');
        $action = $request->input('action', 'impression');

        try {
            // Ensure file exists
            if (!file_exists($logPath)) {
                file_put_contents($logPath, '');
            }

            $fp = fopen($logPath, 'c+');
            if (!$fp) {
                throw new \Exception("Unable to open log file.");
            }

            // Lock the file for reading/writing
            if (flock($fp, LOCK_EX)) {
                // Read the existing contents
                $lines = [];
                rewind($fp);
                while (($line = fgets($fp)) !== false) {
                    $lines[] = trim($line);
                }

                // Parse lines into array
                $data = collect($lines)->filter(fn($line) => str_contains($line, ':'))
                    ->mapWithKeys(function ($line) {
                        [$date, $rest] = explode(': ', $line, 2);
                        [$imp, $click] = array_pad(explode(' | ', $rest), 2, 0);
                        return [$date => [
                            'impressions' => (int) $imp,
                            'clicks' => (int) $click,
                        ]];
                    })->toArray();

                // Update today's data
                $todayData = $data[$today] ?? ['impressions' => 0, 'clicks' => 0];

                if ($action === 'click') {
                    $todayData['clicks'] += 1;
                    \Log::info("🖱️ Click counted for $today: " . $todayData['clicks']);
                } else {
                    $todayData['impressions'] += 1;
                    \Log::info("👁️ Impression counted for $today: " . $todayData['impressions']);
                }

                $data[$today] = $todayData;

                // Rewrite the file safely
                $content = collect($data)->map(fn($counts, $date) =>
                    "$date: {$counts['impressions']} | {$counts['clicks']}"
                )->implode("\n");

                ftruncate($fp, 0);      // Clear the file
                rewind($fp);            // Move to beginning
                fwrite($fp, $content);  // Write new content
                fflush($fp);            // Flush buffer
                flock($fp, LOCK_UN);    // Unlock file
            }

            fclose($fp); // Always close the file
            \Log::info("✅ Log updated for $today");

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            \Log::error('❌ Error in ImpressionController: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
<!-- resources/views/admin/voting-results.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Voting Results') }}
        </h2>
    </x-slot>

    <style>
        .category-card {
            background: #f3f4f6;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid #e5e7eb;
        }
        .category-card.bike {
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            box-shadow: none;
        }
        .category-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .category-title {
            color: #1f2937;
            font-size: 1.25rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .category-title svg {
            width: 24px;
            height: 24px;
        }
        .vehicles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 16px;
        }
        .vehicle-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .vehicle-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        .vehicle-card.winner {
            border: 3px solid #fbbf24;
            position: relative;
        }
        .vehicle-image-container {
            position: relative;
            height: 100px;
            overflow: hidden;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ec 100%);
        }
        .vehicle-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 8px;
            transition: transform 0.3s ease;
        }
        .vehicle-card:hover .vehicle-image {
            transform: scale(1.1);
        }
        .rank-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12px;
            z-index: 10;
        }
        .rank-1 {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(251, 191, 36, 0.4);
        }
        .rank-2 {
            background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
            color: white;
        }
        .rank-3 {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            color: white;
        }
        .rank-other {
            background: rgba(0, 0, 0, 0.6);
            color: white;
        }
        .vehicle-info {
            padding: 12px;
            text-align: center;
        }
        .vehicle-name {
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
            line-height: 1.3;
            min-height: 34px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .percentage-display {
            display: inline-flex;
            align-items: baseline;
            gap: 2px;
        }
        .percentage-value {
            font-size: 24px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .bike .percentage-value {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .percentage-symbol {
            font-size: 14px;
            font-weight: 600;
            color: #6b7280;
        }
        .stats-header {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .stat-icon.cars {
            background: linear-gradient(135deg, #a5b4fc 0%, #818cf8 100%);
        }
        .stat-icon.bikes {
            background: linear-gradient(135deg, #6ee7b7 0%, #34d399 100%);
        }
        .stat-icon svg {
            width: 24px;
            height: 24px;
            color: white;
        }
        .stat-info h3 {
            font-size: 12px;
            font-weight: 500;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .stat-info p {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
        }
        .tab-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .tab-nav {
            display: flex;
            border-bottom: 1px solid #e5e7eb;
        }
        .tab-btn {
            flex: 1;
            padding: 16px 24px;
            font-weight: 600;
            font-size: 14px;
            color: #6b7280;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .tab-btn:hover {
            background: #f9fafb;
        }
        .tab-btn.active {
            color: #818cf8;
            border-bottom: 3px solid #818cf8;
            margin-bottom: -1px;
        }
        .tab-btn.active.bikes-active {
            color: #34d399;
            border-bottom-color: #34d399;
        }
        .tab-content {
            padding: 24px;
        }
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #9ca3af;
        }
        .empty-state svg {
            width: 48px;
            height: 48px;
            margin: 0 auto 16px;
        }
        @media (max-width: 768px) {
            .stats-header {
                grid-template-columns: 1fr;
            }
            .vehicles-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Stats Header Removed -->

            <!-- Main Tab Container -->
            <div class="tab-container">
                <!-- Tab Navigation -->
                <div class="tab-nav">
                    <button type="button" onclick="switchResultsTab('cars')" id="cars-tab" class="tab-btn active">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                        </svg>
                        Car Results
                    </button>
                    <button type="button" onclick="switchResultsTab('bikes')" id="bikes-tab" class="tab-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Bike Results
                    </button>
                </div>

                <!-- Cars Results Content -->
                <div id="cars-content" class="tab-content results-content">
                    @foreach($carResults as $catKey => $category)
                        <div class="category-card">
                            <div class="category-header">
                                <div class="category-title">
                                    {{ $category['name'] }}
                                </div>
                            </div>

                            @if(count($category['nominations']) > 0)
                                <div class="vehicles-grid">
                                    @foreach($category['nominations'] as $index => $nomination)
                                        <div class="vehicle-card {{ $index === 0 ? 'winner' : '' }}">
                                            <div class="vehicle-image-container">
                                                <div class="rank-badge {{ $index === 0 ? 'rank-1' : ($index === 1 ? 'rank-2' : ($index === 2 ? 'rank-3' : 'rank-other')) }}">
                                                    {{ $index + 1 }}
                                                </div>
                                                <img class="vehicle-image" 
                                                     src="{{ asset($nomination['image']) }}" 
                                                     alt="{{ $nomination['name'] }}"
                                                     onerror="this.src='https://via.placeholder.com/180x100/e5e7eb/6b7280?text=N/A'">
                                            </div>
                                            <div class="vehicle-info">
                                                <div class="vehicle-name">{{ $nomination['name'] }}</div>
                                                <div class="percentage-display">
                                                    <span class="percentage-value">{{ $nomination['percentage'] }}</span>
                                                    <span class="percentage-symbol">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    <p>No votes recorded for this category yet.</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Bikes Results Content -->
                <div id="bikes-content" class="tab-content results-content hidden">
                    @foreach($bikeResults as $catKey => $category)
                        <div class="category-card bike">
                            <div class="category-header">
                                <div class="category-title">
                                    {{ $category['name'] }}
                                </div>
                            </div>

                            @if(count($category['nominations']) > 0)
                                <div class="vehicles-grid">
                                    @foreach($category['nominations'] as $index => $nomination)
                                        <div class="vehicle-card {{ $index === 0 ? 'winner' : '' }}">
                                            <div class="vehicle-image-container">
                                                <div class="rank-badge {{ $index === 0 ? 'rank-1' : ($index === 1 ? 'rank-2' : ($index === 2 ? 'rank-3' : 'rank-other')) }}">
                                                    {{ $index + 1 }}
                                                </div>
                                                <img class="vehicle-image" 
                                                     src="{{ asset($nomination['image']) }}" 
                                                     alt="{{ $nomination['name'] }}"
                                                     onerror="this.src='https://via.placeholder.com/180x100/e5e7eb/6b7280?text=N/A'">
                                            </div>
                                            <div class="vehicle-info bike">
                                                <div class="vehicle-name">{{ $nomination['name'] }}</div>
                                                <div class="percentage-display">
                                                    <span class="percentage-value">{{ $nomination['percentage'] }}</span>
                                                    <span class="percentage-symbol">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    <p>No votes recorded for this category yet.</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <script>
        function switchResultsTab(tab) {
            // Hide all content
            document.querySelectorAll('.results-content').forEach(el => {
                el.classList.add('hidden');
            });
            
            // Remove active state from all tabs
            document.querySelectorAll('.tab-btn').forEach(el => {
                el.classList.remove('active', 'bikes-active');
            });
            
            // Show selected content
            document.getElementById(tab + '-content').classList.remove('hidden');
            
            // Add active state to selected tab
            const activeTab = document.getElementById(tab + '-tab');
            activeTab.classList.add('active');
            if (tab === 'bikes') {
                activeTab.classList.add('bikes-active');
            }
        }
    </script>
</x-app-layout>

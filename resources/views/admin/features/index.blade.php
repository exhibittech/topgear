<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Features Management') }}
        </h2>
    </x-slot>

    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <!-- Search and page length control -->
            <form method="GET" action="{{ route('adminfeatures.index') }}" class="flex items-center mb-4 space-x-4">
                <input type="text" name="search" placeholder="Search Features..." value="{{ request('search') }}" class="mr-2 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <select name="pageLength" class="mr-2 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" onchange="this.form.submit()">
                    <option value="10" {{ request('pageLength') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('pageLength') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('pageLength') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('pageLength') == 100 ? 'selected' : '' }}>100</option>
                </select>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Search</button>
            </form>

            <div class="flex justify-between mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">All Features</h3>
                <a href="{{ route('adminfeatures.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Create New Feature Post
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse bg-white shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Feature Title</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Category</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Author</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Publish Date</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($features as $feature)
                            <tr class="border-b hover:bg-gray-50 transition duration-200 {{ $loop->odd ? 'bg-gray-50' : 'bg-white' }}">
                                <!-- Feature Title -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $feature->Name }}
                                </td>
                                
                                <!-- Category with a Tag Style -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        {{ $feature->category->Name ?? 'No Category' }}
                                    </span>
                                </td>

                                <!-- Author Name Styled -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 19.121a4 4 0 010-5.656l5.657-5.657a4 4 0 015.657 0l5.657 5.657a4 4 0 010 5.656l-5.657 5.657a4 4 0 01-5.657 0l-5.657-5.657z"></path></svg>
                                        {{ $feature->Author ?? 'N/A' }}
                                    </span>
                                </td>

                                <!-- Publish Date with Icon -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ \Carbon\Carbon::parse($feature->PublishDate)->format('M d, Y') }}
                                    </span>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($feature->IsActive)
                                        <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Active</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Inactive</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('adminfeatures.edit', $feature->FeatureID) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                    <form action="{{ route('adminfeatures.destroy', $feature->FeatureID) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this feature?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $features->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

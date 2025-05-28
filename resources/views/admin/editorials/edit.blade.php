<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Editorial Post') }}
        </h2>
    </x-slot>

    <!-- Progress Bar -->
    <div class="w-full bg-gray-300 h-2 mb-6 rounded-full overflow-hidden">
        <div id="progress-bar" class="bg-indigo-600 h-full" style="width: 0%;"></div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md sm:rounded-lg p-8">
            @if (session('succ_msg'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">{{ session('succ_msg') }}</strong>
                </div>
            @endif

            @if (session('err_msg'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">{{ session('err_msg') }}</strong>
                </div>
            @endif

            <!-- Update Editorial Form -->
            <form action="{{ route('admineditorials.update', $editorial->EditorialID) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Section: Basic Information -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold leading-6 text-gray-900 border-b pb-2 mb-4">Basic Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name Field -->
                        <div class="space-y-2">
                            <label for="Name" class="block text-sm font-semibold text-gray-700">Editorial Title</label>
                            <input type="text" name="Name" value="{{ old('Name', $editorial->Name) }}" class="block w-full px-3 py-2 border @error('Name') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="Name" placeholder="Enter editorial title" required>
                            @error('Name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section: Upload Image -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold leading-6 text-gray-900 border-b pb-2 mb-4">Upload Featured Image</h3>
                    <div class="space-y-2">
                        <label for="Thumbimage" class="block text-sm font-semibold text-gray-700">Upload Featured Image <span class="text-gray-500 text-sm">(Max: 1MB)</span></label>
                        <input type="file" name="Thumbimage" class="block w-full text-sm text-gray-900 border @error('Thumbimage') border-red-500 @else border-gray-300 @enderror rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500" id="Thumbimage">
                        
                        <!-- Display existing image -->
                        @if($editorial->ImagePath)
                            <div id="featuredImagePreview" class="mt-3">
                                <img src="{{ asset($editorial->ImagePath) }}" alt="Featured Image" class="rounded-md shadow-md max-w-full h-auto">
                            </div>
                        @endif

                        @error('Thumbimage')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Section: Description -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold leading-6 text-gray-900 border-b pb-2 mb-4">Description</h3>
                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-semibold text-gray-700">Description</label>
                        <textarea name="description" id="description" class="block w-full px-3 py-2 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description', $editorial->Description) }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Section: SEO Information -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold leading-6 text-gray-900 border-b pb-2 mb-4">SEO Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Meta Title -->
                        <div class="space-y-2">
                            <label for="MetaTitle" class="block text-sm font-semibold text-gray-700">Meta Title <span id="metaTitleCounter" class="text-gray-500 text-xs">(0/60)</span></label>
                            <input type="text" name="MetaTitle" value="{{ old('MetaTitle', $editorial->MetaTitle) }}" class="block w-full px-3 py-2 border @error('MetaTitle') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="MetaTitle" placeholder="Enter Meta Title">
                            @error('MetaTitle')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Meta Keyword -->
                        <div class="space-y-2">
                            <label for="Keyword" class="block text-sm font-semibold text-gray-700">Meta Keyword</label>
                            <input type="text" name="Keyword" value="{{ old('Keyword', $editorial->Keyword) }}" class="block w-full px-3 py-2 border @error('Keyword') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="Keyword" placeholder="Enter Meta Keyword">
                            @error('Keyword')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Meta Description -->
                    <div class="space-y-2">
                        <label for="MetaDescription" class="block text-sm font-semibold text-gray-700">Meta Description <span id="metaDescriptionCounter" class="text-gray-500 text-xs">(0/160)</span></label>
                        <textarea name="MetaDescription" rows="4" class="block w-full px-3 py-2 border @error('MetaDescription') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="MetaDescription">{{ old('MetaDescription', $editorial->MetaDescription) }}</textarea>
                        @error('MetaDescription')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Section: Publish Information -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold leading-6 text-gray-900 border-b pb-2 mb-4">Publish Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Author Name -->
                        <div class="space-y-2">
                            <label for="Author" class="block text-sm font-semibold text-gray-700">Author Name</label>
                            <input type="text" disabled name="Author" value="{{ old('Author', $editorial->Author) }}" class="block w-full px-3 py-2 border @error('Author') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="Author" placeholder="Author Name" required>
                            @error('Author')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Publish Date -->
                        <div class="space-y-2">
                            <label for="PublishDate" class="block text-sm font-semibold text-gray-700">Publish Date</label>
                            <input type="date" name="PublishDate" value="{{ old('PublishDate', $editorial->PublishDate) }}" class="block w-full px-3 py-2 border @error('PublishDate') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text                             sm" id="PublishDate" required>
                            @error('PublishDate')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Status</label>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <input class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" type="radio" name="IsActive" id="inlineRadio1" value="1" {{ old('IsActive', $editorial->IsActive) == '1' ? 'checked' : '' }}>
                                <label for="inlineRadio1" class="ml-2 block text-sm text-gray-700">Active</label>
                            </div>
                            <div class="flex items-center">
                                <input class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" type="radio" name="IsActive" id="inlineRadio2" value="0" {{ old('IsActive', $editorial->IsActive) == '0' ? 'checked' : '' }}>
                                <label for="inlineRadio2" class="ml-2 block text-sm text-gray-700">Inactive</label>
                            </div>
                        </div>
                        @error('IsActive')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center pt-6">
                    <button type="submit" name="update" class="inline-flex justify-center py-3 px-5 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                       Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Include TinyMCE CDN for rich text editing -->
    <script src="https://cdn.tiny.cloud/1/u401ssr4kqb7eo68dsbitofyye9xyg1dgr3vqkbkkqcu4fdz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#description',
            plugins: 'link image code',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code',
            height: 300
        });

        // Preview featured image
        document.getElementById('Thumbimage').addEventListener('change', function() {
            let preview = document.getElementById('featuredImagePreview');
            preview.innerHTML = ''; // Clear previous content

            let reader = new FileReader();
            reader.onload = function (e) {
                let img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('rounded-md', 'shadow-md', 'mt-2', 'max-w-full', 'h-auto');
                preview.appendChild(img);
            }
            reader.readAsDataURL(this.files[0]);
        });

        // Meta Title Character Counter and Validation
        document.getElementById('MetaTitle').addEventListener('input', function() {
            let counter = document.getElementById('metaTitleCounter');
            let length = this.value.length;
            counter.textContent = `(${length}/60)`;

            if (length > 60) {
                this.classList.add('border-red-500', 'text-red-600');
                counter.classList.add('text-red-600');
            } else {
                this.classList.remove('border-red-500', 'text-red-600');
                counter.classList.remove('text-red-600');
            }
        });

        // Meta Description Character Counter and Validation
        document.getElementById('MetaDescription').addEventListener('input', function() {
            let counter = document.getElementById('metaDescriptionCounter');
            let length = this.value.length;
            counter.textContent = `(${length}/160)`;

            if (length > 160) {
                this.classList.add('border-red-500', 'text-red-600');
                counter.classList.add('text-red-600');
            } else {
                this.classList.remove('border-red-500', 'text-red-600');
                counter.classList.remove('text-red-600');
            }
        });

        // Progress Bar Update
        document.querySelectorAll('input, textarea, select').forEach(element => {
            element.addEventListener('input', updateProgressBar);
        });

        function updateProgressBar() {
            const totalInputs = document.querySelectorAll('input, textarea, select').length;
            const filledInputs = Array.from(document.querySelectorAll('input, textarea, select')).filter(el => el.value).length;
            const progressPercentage = Math.round((filledInputs / totalInputs) * 100);

            document.getElementById('progress-bar').style.width = `${progressPercentage}%`;
        }
    </script>
</x-app-layout>


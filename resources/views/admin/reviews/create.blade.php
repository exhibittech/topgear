<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Review Post') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md sm:rounded-lg p-8">
            @if (session('succ_msg'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('succ_msg') }}
                </div>
            @endif

            @if (session('err_msg'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('err_msg') }}
                </div>
            @endif

            <form action="{{ route('adminreviews.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Section: Basic Information -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold leading-6 text-gray-900 border-b pb-2 mb-4">Basic Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- MenuID Dropdown -->
                        <div class="space-y-2">
                            <label for="MenuID" class="block text-sm font-semibold text-gray-700">Select Category</label>
                            <select name="MenuID" id="MenuID" class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" selected>Select Category (Car or Bike)</option>
                                <option value="9">Car</option>
                                <option value="11">Bike</option>
                            </select>
                        </div>

                        <!-- ReviewsCategory Dropdown -->
                        <div class="space-y-2">
                            <label for="ReviewsCategoryID" class="block text-sm font-semibold text-gray-700">Select Reviews Category</label>
                            <select name="ReviewsCategoryID" id="ReviewsCategoryID" class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" selected disabled>Select Review Category</option>
                            </select>
                        </div>

                        <!-- Title -->
                        <div class="space-y-2">
                            <label for="ReviewsTitle" class="block text-sm font-semibold text-gray-700">Title</label>
                            <input type="text" name="ReviewsTitle" class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Title" required>
                        </div>
                    </div>
                </div>

                <!-- Section: Additional Information -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold leading-6 text-gray-900 border-b pb-2 mb-4">Additional Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Rating -->
                        <div class="space-y-2">
                            <label for="Rating" class="block text-sm font-semibold text-gray-700">Rating (Max Value 10)</label>
                            <input type="number" name="Rating" max="10" class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Rating">
                        </div>

                        <!-- Punch Line -->
                        <div class="space-y-2">
                            <label for="PunchLine" class="block text-sm font-semibold text-gray-700">Punch Line</label>
                            <input type="text" name="PunchLine" class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Punch Line">
                        </div>

                        <!-- Good Stuff -->
                        <div class="space-y-2">
                            <label for="GoodStuff" class="block text-sm font-semibold text-gray-700">Good Stuff</label>
                            <input type="text" name="GoodStuff" class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Good Stuff" >
                        </div>

                        <!-- Bad Stuff -->
                        <div class="space-y-2">
                            <label for="BadStuff" class="block text-sm font-semibold text-gray-700">Bad Stuff</label>
                            <input type="text" name="BadStuff" class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Bad Stuff" >
                        </div>
                    </div>
                </div>

                <!-- Section: Upload Images -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold leading-6 text-gray-900 border-b pb-2 mb-4">Upload Images</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Featured Image -->
                        <div class="space-y-2">
                            <label for="Thumbimage" class="block text-sm font-semibold text-gray-700">Upload Featured Image <span class="text-gray-500 text-sm">(1300 x 728, Max: 428KB)</span></label>
                            <input type="file" name="Thumbimage" id="Thumbimage" class="block w-full text-sm text-gray-900 border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <div id="featuredImagePreview" class="mt-3"></div>
                        </div>

                        <!-- Slider Images -->
                        <div class="space-y-2">
                            <label for="Image" class="block text-sm font-semibold text-gray-700">Slider Images (Upload multiple) <span class="text-gray-500 text-sm">(1300 x 728, Max: 428KB per image)</span></label>
                            <input type="file" name="Image[]" id="Image" multiple class="block w-full text-sm text-gray-900 border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <div id="imagePreview" class="mt-3 flex flex-wrap gap-4"></div>
                        </div>
                    </div>
                </div>

                  <!-- Tabs Navigation and Content -->
                <div>
                    <ul class="flex border-b" id="tab-list"></ul>
                    <div id="tab-content" class="p-4 bg-gray-50 rounded-lg mt-2"></div>
                </div>


                <!-- Section: SEO Information -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold leading-6 text-gray-900 border-b pb-2 mb-4">SEO Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Meta Title -->
                        <div class="space-y-2">
                            <label for="MetaTitle" class="block text-sm font-semibold text-gray-700">Meta Title <span id="metaTitleCounter" class="text-gray-500 text-xs">(0/60)</span></label>
                            <input type="text" name="MetaTitle" id="MetaTitle" class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Meta Title">
                        </div>

                        <!-- Meta Description -->
                        <div class="space-y-2">
                            <label for="MetaDescription" class="block text-sm font-semibold text-gray-700">Meta Description <span id="metaDescriptionCounter" class="text-gray-500 text-xs">(0/160)</span></label>
                            <input type="text" name="MetaDescription" id="MetaDescription" class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Meta Description">
                        </div>

                        <!-- Meta Keywords -->
                        <div class="space-y-2">
                            <label for="Keyword" class="block text-sm font-semibold text-gray-700">Meta Keywords</label>
                            <input type="text" name="Keyword" class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Meta Keywords">
                        </div>
                    </div>
                </div>

                <!-- Section: Publish Information -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold leading-6 text-gray-900 border-b pb-2 mb-4">Publish Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Author Name -->
                        <div class="space-y-2">
                            <label for="Author" class="block text-sm font-semibold text-gray-700">Author Name</label>
                            <input type="text" name="Author" value="{{ Auth::user()->name }}" class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Author Name" required>
                        </div>

                        <!-- Publish Date -->
                        <div class="space-y-2">
                            <label for="PublishDate" class="block text-sm font-semibold text-gray-700">Publish Date</label>
                            <input type="date" name="PublishDate" class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>

                        <!-- Status -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Status</label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="IsActive" value="1" class="form-radio text-indigo-600" checked> Active
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="IsActive" value="0" class="form-radio text-indigo-600"> Inactive
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs Navigation and Content -->
                

                <!-- Submit Button -->
                <div class="text-center pt-6">
                    <button type="submit" class="inline-flex justify-center py-3 px-5 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add TinyMCE CDN -->
    <script src="https://cdn.tiny.cloud/1/u401ssr4kqb7eo68dsbitofyye9xyg1dgr3vqkbkkqcu4fdz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Meta Title and Meta Description Character Counter Script -->
    <script>
         document.getElementById('MenuID').addEventListener('change', function () {
            const menuId = this.value;
            const categoryDropdown = document.getElementById('ReviewsCategoryID');
    
            // Fetch categories based on MenuID
            fetch('/adminreviews/fetch-category', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ menu_id: menuId })
            })
            .then(response => response.json())
            .then(data => {
                categoryDropdown.innerHTML = '';
                data.forEach(category => {
                    categoryDropdown.innerHTML += `<option value="${category.ID}">${category.Name}</option>`;
                });
            })
            .catch(error => console.error('Error fetching categories:', error));
    
            // Fetch tabs based on MenuID
            fetch('/adminreviews/fetch-tabs', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ menu_id: menuId })
            })
            .then(response => response.json())
            .then(tabs => {
                const tabList = document.getElementById('tab-list');
                const tabContent = document.getElementById('tab-content');
    
                // Clear previous tabs and content
                tabList.innerHTML = '';
                tabContent.innerHTML = '';
    
                // Loop through the fetched tabs and create the tab navigation and content
                tabs.forEach((tab, index) => {
                    // Create Tab Navigation Button with remove icon
                    const isActive = index === 0 ? 'active' : ''; // Set the first tab as active by default
                    tabList.innerHTML += `
                        <li class="-mb-px mr-1">
                            <a class="tab-btn ${isActive} bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-700 font-semibold relative" 
                               data-tab="${tab.TabID}" href="#tab_${tab.TabID}">
                                ${tab.Name}
                                <button type="button" class="remove-tab absolute top-0 right-0 text-red-600 text-lg" data-remove="${tab.TabID}">&times;</button>
                            </a>
                        </li>
                    `;
    
                    // Create Tab Content (Textarea for each tab)
                    tabContent.innerHTML += `
                        <div class="tab-content-item ${isActive}" id="tab_${tab.TabID}" style="${index === 0 ? 'display: block;' : 'display: none;'}">
                            <textarea name="tabscontent[${tab.TabID}]" class="tiny-editor"></textarea>
                        </div>
                    `;
                });
    
                // Reinitialize TinyMCE editors for dynamically added textareas
                tinymce.remove('.tiny-editor'); // Clear previous TinyMCE instances
                tinymce.init({
                    selector: '.tiny-editor',
                    plugins: 'link image code',
                    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code',
                    height: 300
                });
    
                // Add tab switching functionality
                document.querySelectorAll('.tab-btn').forEach(tabBtn => {
                    tabBtn.addEventListener('click', function (event) {
                        event.preventDefault();
                        const targetTabId = this.getAttribute('data-tab');
    
                        // Remove active class from all tabs and hide all content
                        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                        document.querySelectorAll('.tab-content-item').forEach(content => content.style.display = 'none');
    
                        // Activate the clicked tab and show corresponding content
                        this.classList.add('active');
                        document.getElementById(`tab_${targetTabId}`).style.display = 'block';
                    });
                });
    
                // Add functionality to remove a tab and its content
                document.querySelectorAll('.remove-tab').forEach(removeBtn => {
                    removeBtn.addEventListener('click', function (event) {
                        event.stopPropagation(); // Prevent triggering the tab switch event
                        const tabId = this.getAttribute('data-remove');
    
                        // Remove the tab and its content
                        document.querySelector(`[data-tab="${tabId}"]`).parentElement.remove(); // Remove tab from list
                        document.getElementById(`tab_${tabId}`).remove(); // Remove content
    
                        // If the removed tab was active, activate the first tab if it exists
                        const firstTab = document.querySelector('.tab-btn');
                        if (firstTab) {
                            firstTab.classList.add('active');
                            const firstTabId = firstTab.getAttribute('data-tab');
                            document.getElementById(`tab_${firstTabId}`).style.display = 'block';
                        }
                    });
                });
            })
            .catch(error => console.error('Error fetching tabs:', error));
        });
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

        // Image Preview Script
        document.getElementById('Thumbimage').addEventListener('change', function() {
            let preview = document.getElementById('featuredImagePreview');
            preview.innerHTML = ''; // Clear previous content

            let reader = new FileReader();
            reader.onload = function(e) {
                let img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('rounded-md', 'shadow-md', 'mt-2', 'max-w-full', 'h-auto');
                preview.appendChild(img);
            };
            reader.readAsDataURL(this.files[0]);
        });

        // Multiple Image Preview Script
        document.getElementById('Image').addEventListener('change', function() {
            let preview = document.getElementById('imagePreview');
            preview.innerHTML = ''; // Clear previous content
            Array.from(this.files).forEach(file => {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('rounded-md', 'shadow-md', 'mt-2', 'max-w-full', 'h-auto', 'object-cover');
                    img.style.width = '100px';
                    img.style.height = '100px';

                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });

        // Initialize TinyMCE for textarea fields
        tinymce.init({
            selector: 'textarea',
            plugins: 'link image code',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code',
            height: 300
        });
    </script>
    <style>
        /* Active Tab Styling */
    .tab-btn.active {
        background-color: #4f46e5; /* Tailwind Indigo-600 */
        color: white;
        border-bottom: 2px solid #4f46e5;
    }
    
    /* Remove Tab Button */
    .remove-tab {
        position: absolute;
        top: -5px;
        right: -5px;
        font-size: 16px;
        background: transparent;
        cursor: pointer;
    }
    
    .remove-tab:hover {
        color: #dc2626; /* Tailwind Red-600 */
    }
    
    </style>
</x-app-layout>

@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 250px; background-color: #f8f9fa; padding: 20px;">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1 text-gray-800">User Management</h1>
                <p class="text-gray-600 mb-0">Complete list of registered users</p>
            </div>

            <div class="d-flex align-items-center">
            <form method="GET" action="{{ route('admin.products.index') }}" class="d-flex align-items-center mt-3">
    <div class="input-group search-container" style="width: 250px;">
        <span class="input-group-text">
            <i class="fas fa-search text-secondary"></i>
        </span>
        <input type="text"
               name="search"
               class="form-control border-start-0 ps-2 py-2"
               placeholder="Search users..."
               value="{{ request('search') }}"
               aria-label="Search"
               id="instantSearchInput"
               style="border-radius: 0 4px 4px 0;">

        @if(request('search'))
        <button type="button"
                class="input-group-text bg-transparent border-0 clear-search-btn"
                onclick="clearSearch()"
                title="Clear search">
            <i class="fas fa-times text-muted"></i>
        </button>
        @endif
    </div>
</form>




                <div class="btn-group mr-3" role="group" style="margin-right: 10px;">
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-file-export mr-2"></i>Export
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.products.export', 'csv') }}">
                                <i class="fas fa-file-csv text-primary mr-2"></i>
                                <div>
                                    <div>CSV</div>
                                    <small class="text-muted">Spreadsheet format</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.products.export', 'excel') }}">
                                <i class="fas fa-file-excel text-success mr-2"></i>
                                <div>
                                    <div>Excel</div>
                                    <small class="text-muted">XLSX file</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.products.export', 'pdf') }}">
                                <i class="fas fa-file-pdf text-danger mr-2"></i>
                                <div>
                                    <div>PDF</div>
                                    <small class="text-muted">Printable document</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('admin.products.create') }}" class="btn btn-primary d-flex align-items-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    <span>Add User</span>
                </a>
            </div>
        </div>

        <div class="alert alert-info border-left-primary shadow-sm">
    <div class="d-flex align-items-center">
        <div>
            <strong>          <i class="fas fa-lightbulb mr-2"></i> Quick Tips:</strong>
            <ul class="mb-1 ps-3" style="list-style-type: circle;">
            <li><strong>Export:</strong> Download user reports in three formats: PDF, Excel, or CSV</li>
<li><strong>Search:</strong> Find users by name or email using the search bar</li>
            </ul>

        </div>
    </div>
</div>


        @if(session('success'))
        <div id="alert-message" class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        </div>
        @endif

        <!-- Products Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($products as $product)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <!-- Product Image -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex-shrink-0 h-12 w-12">
                                    @if($product->image)
                                    <img class="h-12 w-12 rounded-md object-cover" src="{{ Storage::url($product->image) }}" alt="Product Image">
                                    @else
                                    <div class="h-12 w-12 rounded-md bg-gray-200 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                            </td>

                            <!-- Product Name -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                <div class="text-sm text-gray-500 truncate max-w-xs">{{ $product->description }}</div>
                            </td>

                            <!-- Price -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $product->price }} DT
                                </span>
                            </td>

                            <!-- Stock -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $product->stock > 10 ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $product->stock }} in stock
                                </span>
                            </td>

                            <!-- Category -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                    {{ $product->category }}
                                </span>
                            </td>

                            <!-- Actions -->
                              <!-- Actions -->
                              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-3">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="text-indigo-600 hover:text-indigo-900 flex items-center p-2 rounded-full hover:bg-indigo-50 transition duration-200"
                                       title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-900 flex items-center p-2 rounded-full hover:bg-red-100 transition duration-200"
                                                title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if(method_exists($products, 'links'))
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('instantSearchInput');
    let searchTimer;

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function() {
                searchInput.form.submit();
            }, 500);
        });

        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.form.submit();
            }
        });
    }

    setTimeout(function() {
        let alertMessage = document.getElementById('alert-message');
        if (alertMessage) {
            alertMessage.style.transition = "opacity 0.5s";
            alertMessage.style.opacity = "0";
            setTimeout(() => alertMessage.style.display = "none", 500);
        }
    }, 2000);
});
</script>
<script>
function clearSearch() {
    // Remove search parameter from URL
    const url = new URL(window.location.href);
    url.searchParams.delete('search');
    window.location.href = url.toString();
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

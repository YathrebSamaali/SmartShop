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
            <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex align-items-center mt-3">
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
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.users.export', 'csv') }}">
                                <i class="fas fa-file-csv text-primary mr-2"></i>
                                <div>
                                    <div>CSV</div>
                                    <small class="text-muted">Spreadsheet format</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.users.export', 'excel') }}">
                                <i class="fas fa-file-excel text-success mr-2"></i>
                                <div>
                                    <div>Excel</div>
                                    <small class="text-muted">XLSX file</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.users.export', 'pdf') }}">
                                <i class="fas fa-file-pdf text-danger mr-2"></i>
                                <div>
                                    <div>PDF</div>
                                    <small class="text-muted">Printable document</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('admin.users.create') }}" class="btn btn-primary d-flex align-items-center">
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

        <div class="bg-white rounded-xl shadow-md overflow-hidden position-relative" style="min-height: 400px;">
            @if($users->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-solid from-blue-50 to-indigo-50">
                            <tr>
                                <th scope="col" style="width: 7%" class="px-4 py-3 text-left text-xs font-semibold text-indigo-800 uppercase tracking-wider">ID</th>
                                <th scope="col" style="width: 25%" class="px-4 py-3 text-left text-xs font-semibold text-indigo-800 uppercase tracking-wider">Name</th>
                                <th scope="col" style="width: 28%" class="px-4 py-3 text-left text-xs font-semibold text-indigo-800 uppercase tracking-wider">Email</th>
                                <th scope="col" style="width:12%" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Role</th>
                                <th scope="col" style="width: 18%" class="px-4 py-3 text-left text-xs font-semibold text-indigo-800 uppercase tracking-wider">Registration</th>
                                <th scope="col" style="width: 10%" class="px-4 py-3 text-right text-xs font-semibold text-indigo-800 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->id }}</div>
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 avatar-cell">
                                            <img class="avatar-img rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=128" alt="{{ $user->name }}">
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($user->is_admin)
                                        <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-purple-100 text-purple-800">Admin</span>
                                        @else
                                        <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-blue-100 text-blue-800">User</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->created_at->format('d/m/Y') }}</div>
                                </td>
                                <!-- In your table row where actions are defined -->
<td class="px-4 py-2 whitespace-nowrap text-right action-cell">
    <div class="flex justify-end space-x-2">
        <!-- Show Button -->
        <a href="{{ route('admin.users.show', $user->id) }}"
           class="text-blue-600 hover:text-blue-900 p-1 rounded-full hover:bg-blue-50"
           title="View Details">
            <i class="fas fa-eye fa-sm"></i>
        </a>

        <!-- Edit Button -->
        <a href="{{ route('admin.users.edit', $user->id) }}"
           class="text-indigo-600 hover:text-indigo-900 p-1 rounded-full hover:bg-indigo-50"
           title="Edit">
            <i class="fas fa-edit fa-sm"></i>
        </a>

        <!-- Delete Button -->
        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="text-red-600 hover:text-red-900 p-1 rounded-full hover:bg-red-50"
                    title="Delete"
                    onclick="return confirm('Are you sure you want to delete this user? ')">
                <i class="fas fa-trash-alt fa-sm"></i>
            </button>
        </form>
    </div>
</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if(method_exists($users, 'links'))
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $users->links() }}
                </div>
                @endif
            @else
                <div class="no-results-overlay d-flex align-items-center justify-content-center">
                    <div class="text-center p-5">
                        <i class="fas fa-search fa-4x text-muted mb-4"></i>
                        <h3 class="text-gray-700 mb-2">No results found</h3>
                        <p class="text-gray-500 mb-4">Your search "{{ request('search') }}" returned no matching users.</p>
                        @if(request('search'))
                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                            <i class="fas fa-undo mr-2"></i> Reset search
                        </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

<style>
.bg-solid {
    background-color: #e9ecef;
    border: 1px solid rgba(0,0,0,0.05);
}
.border-indigo-100 {
    border-color:rgba(255, 255, 255, 0.5);
}
.table-container {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05),
                0 2px 4px -1px rgba(0, 0, 0, 0.02);
}
.table tr {
    height: 60px;
}
.table td {
    padding-top: 0.5rem !important;
    padding-bottom: 0.5rem !important;
    vertical-align: middle !important;
}
.table th {
    padding-top: 0.75rem !important;
    padding-bottom: 0.75rem !important;
}
.avatar-cell {
    width: 40px !important;
    padding-right: 0 !important;
}
.avatar-img {
    width: 36px !important;
    height: 36px !important;
}
.action-cell {
    white-space: nowrap;
    width: 120px;
}
.search-container {
    border: 1px solid #212529; /* Black border */
    border-radius: 6px;
    overflow: hidden;
    background-color: transparent; /* Transparent background */
    transition: all 0.3s ease;
    margin-right: 10px;
}
.search-container:focus-within {
    box-shadow: 0 0 0 2px rgba(33, 37, 41, 0.25); /* Focus effect */
}

.search-container .input-group-text {
    background-color: transparent !important; /* Transparent background */
    border-right: none !important;
    border-color: #212529 !important; /* Black border */
}

.search-container .form-control {
    background-color: transparent !important; /* Transparent background */
    border-color: #212529 !important; /* Black border */
    border-left: none !important;
    box-shadow: none !important;
}
.form-control {

    font-size: 0.95rem;
    height: 38px;
    border: 1px solid #212529 !important;
    border-left: none !important;
    border-right: none !important;
}
.clear-search-btn {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 5;
    background: transparent !important;
    border: none !important;
    cursor: pointer;
    color: #dc3545 !important;
}


.clear-search-btn i {
    font-size: 0.9rem;
}

.no-results-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
}
.input-group-text {
    background-color:rgb(248, 250, 248) !important;
    border-right: none !important;
    padding: 0 12px;
}
.fa-search {
    font-size: 0.9rem;
    color: #212529;
}
.input-group-text,
.form-control,
.clear-search-btn {
    margin: -1px;
}
</style>

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

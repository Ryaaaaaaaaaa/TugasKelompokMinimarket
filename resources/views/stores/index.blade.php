<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stores Index</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">List of Stores</h1>
        <a href="#" class="btn btn-primary mb-3">Add New Store</a>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stores as $store)
                    <tr>
                        <td>{{ $store->id }}</td>
                        <td>{{ $store->name }}</td>
                        <td>{{ $store->location }}</td>
                        <td>
                            @if ($store['image-url'])
                                <img src="{{ $store['image-url'] }}" alt="Store Image" width="100">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No stores available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>

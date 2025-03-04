<div class="card mb-4">
    <div class="card-header">
        <h2>Chỉnh sửa size</h2>
    </div>
    <div class="card-body">
        <form action="{{ isset($sizeid) ? route('admin.size.update', $sizeid->id) : '#' }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="ten_danh_muc" class="form-label">Tên Size</label>
                <input type="text" class="form-control" name="name"
                    value="{{ old('name', optional($sizeid)->name) }}">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>

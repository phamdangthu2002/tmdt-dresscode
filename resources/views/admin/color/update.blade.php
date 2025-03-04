<div class="card mb-4">
    <div class="card-header">
        <h2>Chỉnh sửa color</h2>
    </div>
    <div class="card-body">
        <form action="{{ isset($colorid) ? route('admin.color.update', $colorid->id) : '#' }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="ten_color" class="form-label">Tên Color</label>
                <input type="text" class="form-control" name="name"
                    value="{{ old('name', optional($colorid)->name) }}">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>

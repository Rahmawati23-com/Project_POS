<form action="{{ route('testimoni.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama_tokoh" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Komentar</label>
        <textarea name="komentar" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label>Rating</label>
        <select name="rating" class="form-control" required>
            <option value="5">5 - Sangat Baik</option>
            <option value="4">4 - Baik</option>
            <option value="3">3 - Cukup</option>
            <option value="2">2 - Kurang</option>
            <option value="1">1 - Buruk</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Kirim Testimoni</button>
</form>

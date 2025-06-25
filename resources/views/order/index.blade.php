@extends('adminlte::page')

@section('title', 'Order Produk')

@section('content_header')
    <h1>Order Produk</h1>
@stop

@section('content')
<div class="container-fluid">
    <!-- Button untuk tambah produk -->
    <div class="row mb-3">
        <div class="col-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
                <i class="fas fa-plus"></i> Tambah Produk
            </button>
        </div>
    </div>

    <!-- Grid produk -->
    <div class="row">
        @foreach($produks as $produk)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm">
                <!-- Gambar produk -->
                <div class="card-img-top text-center bg-light p-2" style="height: 200px;">
                    @if($produk->foto)
                        <img src="{{ asset('foto_produk/' . $produk->foto) }}"
                            class="img-fluid"
                            style="max-height: 180px; object-fit: contain;"
                            alt="{{ $produk->nama }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    @endif
                </div>
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title font-weight-bold">{{ $produk->nama }}</h5>
                    @if($produk->deskripsi)
                        <p class="card-text text-muted small">{{ Str::limit($produk->deskripsi, 100) }}</p>
                    @endif
                    <h6 class="text-primary font-weight-bold mb-3">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </h6>
                    <p class="text-muted mb-2">
                        Stok: <strong class="produk-stok" data-produk-id="{{ $produk->id }}">{{ $produk->stok }}</strong>
                    </p>
                    <div class="mt-auto">
                        @if($produk->stok > 0)
                            <button type="button" class="btn btn-primary btn-block add-to-cart-btn" 
                                    data-produk-id="{{ $produk->id }}" 
                                    data-produk-nama="{{ $produk->nama }}" 
                                    data-produk-harga="{{ $produk->harga }}">
                                <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                            </button>
                        @else
                            <button type="button" class="btn btn-secondary btn-block" disabled>
                                <i class="fas fa-times"></i> Stok Habis
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($produks->isEmpty())
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i>
                Belum ada produk yang tersedia. Silakan tambah produk baru.
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Modal Tambah Produk -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addProductModalLabel">
                        <i class="fas fa-plus-circle"></i> Tambah Produk Baru
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto">Gambar Produk</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto" accept="image/*">
                                    <label class="custom-file-label" for="foto">Pilih gambar...</label>
                                </div>
                                <small class="form-text text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB.</small>
                            </div>
                            <div class="form-group">
                                <div id="imagePreview" class="border rounded p-3 text-center" style="min-height: 200px; display: none;">
                                    <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 180px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" id="harga" name="harga" min="0" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="form-control" id="kategori" name="kategori_id">
                                    <option value="">Pilih Kategori</option>
                                    @if(isset($kategoris))
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" min="0" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Produk</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi produk..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SIDEBAR KERANJANG -->
<div id="sidebarCart" class="cart-sidebar">
    <div class="cart-header">
        <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Keranjang Belanja</h5>
        <button class="btn btn-sm btn-outline-secondary" onclick="toggleCart(false)">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <div class="cart-body">
        <div id="cartEmpty" class="text-center py-5">
            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
            <p class="text-muted">Keranjang Anda kosong</p>
            <small class="text-muted">Tambahkan produk untuk mulai berbelanja</small>
        </div>
        
        <div id="cartItems" style="display: none;">
            <div id="cartList"></div>
        </div>
    </div>
    
    <div class="cart-footer" id="cartFooter" style="display: none;">
        <div class="cart-summary">
            <div class="d-flex justify-content-between mb-2">
                <span>Subtotal:</span>
                <span id="cartSubtotal">Rp 0</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span>Ongkir:</span>
                <span class="text-success">Gratis</span>
            </div>
            <hr class="my-2">
            <div class="d-flex justify-content-between font-weight-bold h5">
                <span>Total:</span>
                <span id="cartTotal" class="text-primary">Rp 0</span>
            </div>
        </div>
        <button class="btn btn-primary btn-block btn-lg" id="checkoutBtn">
            <i class="fas fa-credit-card"></i> Bayar Sekarang
        </button>
        <button class="btn btn-outline-secondary btn-block mt-2" onclick="toggleCart(false)">
            Lanjut Belanja
        </button>
    </div>
</div>

<!-- Overlay untuk cart -->
<div id="cartOverlay" class="cart-overlay" onclick="toggleCart(false)"></div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .cart-sidebar {
        position: fixed;
        top: 0;
        right: -420px;
        width: 400px;
        height: 100vh;
        background: #fff;
        box-shadow: -5px 0 15px rgba(0,0,0,0.1);
        z-index: 1060;
        transition: right 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
    }

    .cart-sidebar.show {
        right: 0;
    }

    .cart-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8f9fa;
    }

    .cart-body {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
    }

    .cart-footer {
        padding: 20px;
        border-top: 1px solid #eee;
        background: #f8f9fa;
    }

    .cart-summary {
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        border: 1px solid #eee;
    }

    .cart-item {
        display: flex;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item-image {
        width: 60px;
        height: 60px;
        background: #f8f9fa;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        border: 1px solid #eee;
    }

    .cart-item-details {
        flex: 1;
    }

    .cart-item-name {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 5px;
        color: #333;
    }

    .cart-item-price {
        color: #007bff;
        font-weight: 600;
        font-size: 14px;
    }

    .cart-item-controls {
        display: flex;
        align-items: center;
        margin-top: 8px;
    }

    .qty-control {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-right: 10px;
    }

    .qty-control button {
        border: none;
        background: none;
        padding: 5px 10px;
        cursor: pointer;
        color: #666;
    }

    .qty-control button:hover {
        background: #f0f0f0;
    }

    .qty-control span {
        padding: 5px 10px;
        min-width: 30px;
        text-align: center;
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
        font-weight: 600;
    }

    .cart-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 1050;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .cart-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .remove-item {
        color: #dc3545;
        cursor: pointer;
        font-size: 12px;
    }

    .remove-item:hover {
        color: #c82333;
    }

    @media (max-width: 768px) {
        .cart-sidebar {
            width: 100%;
            right: -100%;
        }
    }
</style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
$(document).ready(function() {
    $('#foto').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImg').attr('src', e.target.result);
                $('#imagePreview').show();
            }
            reader.readAsDataURL(file);
            $(this).next('.custom-file-label').text(file.name);
        } else {
            $('#imagePreview').hide();
            $(this).next('.custom-file-label').text('Pilih gambar...');
        }
    });

    $('#addProductModal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $('#imagePreview').hide();
        $('.custom-file-label').text('Pilih gambar...');
    });

    // Event listener untuk tombol add to cart
    $('.add-to-cart-btn').on('click', function() {
        console.log('Button clicked!'); // Debug
        const id = $(this).data('produk-id');
        const nama = $(this).data('produk-nama');
        const harga = $(this).data('produk-harga');
        console.log('Data:', {id, nama, harga}); // Debug
        addToCart(id, nama, harga);
    });
});

let cart = [];

// Pastikan function tersedia di global scope
window.toggleCart = function(show = true) {
    console.log('toggleCart called:', show); // Debug
    const sidebar = document.getElementById('sidebarCart');
    const overlay = document.getElementById('cartOverlay');
    
    if (show) {
        sidebar.classList.add('show');
        overlay.classList.add('show');
    } else {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    }
}

window.addToCart = function(id, nama, harga) {
    console.log('addToCart called:', {id, nama, harga}); // Debug
    
    // Cek stok di frontend dulu
    const stokElement = $(`.produk-stok[data-produk-id="${id}"]`);
    const currentStok = parseInt(stokElement.text());
    
    if (currentStok <= 0) {
        toastr.error('Stok produk habis!');
        return;
    }
    
    // Cek apakah sudah ada di cart dan total tidak melebihi stok
    const existing = cart.find(item => item.id === id);
    const qtyInCart = existing ? existing.qty : 0;
    
    if (qtyInCart >= currentStok) {
        toastr.warning('Tidak bisa menambah lagi, stok terbatas!');
        return;
    }
    
    // Tambah ke cart
    if (existing) {
        existing.qty += 1;
    } else {
        cart.push({ id: id, nama: nama, harga: harga, qty: 1, stokAsli: currentStok });
    }
    
    // Update tampilan stok di frontend
    const newStok = currentStok - 1;
    stokElement.text(newStok);
    
    // Disable tombol jika stok habis
    if (newStok <= 0) {
        $(`.add-to-cart-btn[data-produk-id="${id}"]`)
            .removeClass('btn-primary')
            .addClass('btn-secondary')
            .prop('disabled', true)
            .html('<i class="fas fa-times"></i> Stok Habis');
    }
    
    updateCartUI();
    toggleCart(true);
    toastr.success(`${nama} ditambahkan ke keranjang!`);
}

window.removeFromCart = function(id) {
    const item = cart.find(item => item.id === id);
    if (item) {
        // Kembalikan stok ke tampilan
        const stokElement = $(`.produk-stok[data-produk-id="${id}"]`);
        const currentStok = parseInt(stokElement.text());
        const newStok = currentStok + item.qty;
        stokElement.text(newStok);
        
        // Enable kembali tombol jika stok tersedia
        const button = $(`.add-to-cart-btn[data-produk-id="${id}"]`);
        if (button.prop('disabled')) {
            button.removeClass('btn-secondary')
                  .addClass('btn-primary')
                  .prop('disabled', false)
                  .html('<i class="fas fa-shopping-cart"></i> Tambah ke Keranjang');
        }
    }
    
    cart = cart.filter(item => item.id !== id);
    updateCartUI();
    toastr.info('Produk dihapus dari keranjang');
}

window.updateQuantity = function(id, change) {
    const item = cart.find(item => item.id === id);
    if (!item) return;
    
    const stokElement = $(`.produk-stok[data-produk-id="${id}"]`);
    const currentStok = parseInt(stokElement.text());
    
    if (change > 0) {
        // Tambah quantity - cek stok
        if (currentStok <= 0) {
            toastr.warning('Stok tidak mencukupi!');
            return;
        }
        item.qty += 1;
        stokElement.text(currentStok - 1);
        
        // Disable tombol jika stok habis
        if (currentStok - 1 <= 0) {
            $(`.add-to-cart-btn[data-produk-id="${id}"]`)
                .removeClass('btn-primary')
                .addClass('btn-secondary')
                .prop('disabled', true)
                .html('<i class="fas fa-times"></i> Stok Habis');
        }
    } else {
        // Kurangi quantity - kembalikan stok
        item.qty -= 1;
        const newStok = currentStok + 1;
        stokElement.text(newStok);
        
        // Enable kembali tombol
        const button = $(`.add-to-cart-btn[data-produk-id="${id}"]`);
        if (button.prop('disabled')) {
            button.removeClass('btn-secondary')
                  .addClass('btn-primary')
                  .prop('disabled', false)
                  .html('<i class="fas fa-shopping-cart"></i> Tambah ke Keranjang');
        }
        
        if (item.qty <= 0) {
            removeFromCart(id);
            return;
        }
    }
    
    updateCartUI();
}

function updateCartUI() {
    const cartList = document.getElementById('cartList');
    const cartEmpty = document.getElementById('cartEmpty');
    const cartItems = document.getElementById('cartItems');
    const cartFooter = document.getElementById('cartFooter');
    const totalDisplay = document.getElementById('cartTotal');
    const subtotalDisplay = document.getElementById('cartSubtotal');
    
    if (cart.length === 0) {
        cartEmpty.style.display = 'block';
        cartItems.style.display = 'none';
        cartFooter.style.display = 'none';
        return;
    }
    
    cartEmpty.style.display = 'none';
    cartItems.style.display = 'block';
    cartFooter.style.display = 'block';
    
    cartList.innerHTML = '';
    let total = 0;

    cart.forEach(item => {
        const itemTotal = item.harga * item.qty;
        total += itemTotal;
        
        const cartItemDiv = document.createElement('div');
        cartItemDiv.className = 'cart-item';
        cartItemDiv.innerHTML = `
            <div class="cart-item-image">
                <i class="fas fa-box text-muted"></i>
            </div>
            <div class="cart-item-details">
                <div class="cart-item-name">${item.nama}</div>
                <div class="cart-item-price">Rp ${item.harga.toLocaleString('id-ID')}</div>
                <div class="cart-item-controls">
                    <div class="qty-control">
                        <button onclick="updateQuantity(${item.id}, -1)">-</button>
                        <span>${item.qty}</span>
                        <button onclick="updateQuantity(${item.id}, 1)">+</button>
                    </div>
                    <span class="remove-item" onclick="removeFromCart(${item.id})">
                        <i class="fas fa-trash"></i> Hapus
                    </span>
                </div>
            </div>
        `;
        cartList.appendChild(cartItemDiv);
    });

    subtotalDisplay.innerText = 'Rp ' + total.toLocaleString('id-ID');
    totalDisplay.innerText = 'Rp ' + total.toLocaleString('id-ID');
}

document.getElementById('checkoutBtn').addEventListener('click', () => {
    if (cart.length === 0) {
        toastr.warning("Keranjang kosong!");
        return;
    }

    // Simulasi proses checkout
    toastr.info("Memproses pembayaran...");
    
    // Kirim data ke server untuk update stok permanen
    const orderData = {
        items: cart.map(item => ({
            produk_id: item.id,
            qty: item.qty,
            harga: item.harga
        })),
        total: cart.reduce((sum, item) => sum + (item.harga * item.qty), 0)
    };
    
    console.log('Order data:', orderData); 
    
    setTimeout(() => {
        toastr.success("Pembayaran berhasil! Terima kasih atas pesanan Anda.");
        
        cart = [];
        updateCartUI();
        toggleCart(false);

    }, 2000);
});
</script>
@stop
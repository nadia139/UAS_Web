<?php
$title = 'Dashboard Admin - Beauty Store';
$active_menu = 'dashboard';
require_once 'views/layouts/header.php';
?>

<div class="row">
    <?php require_once 'views/admin/sidebar.php'; ?>

    <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h4>
            <div class="d-flex">
                <span class="badge bg-primary me-2">
                    <i class="fas fa-clock"></i> <?php echo date('d M Y, H:i'); ?>
                </span>
                <span class="badge bg-success">
                    <i class="fas fa-box"></i> <?php echo $stats['total_products']; ?> Produk
                </span>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card stat-1">
                    <i class="fas fa-boxes"></i>
                    <h3><?php echo $stats['total_products']; ?></h3>
                    <p>Total Produk</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card stat-2">
                    <i class="fas fa-layer-group"></i>
                    <h3><?php echo $stats['total_stock']; ?></h3>
                    <p>Total Stok</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card stat-3">
                    <i class="fas fa-money-bill-wave"></i>
                    <h3>Rp <?php echo number_format($stats['total_value'], 0, ',', '.'); ?></h3>
                    <p>Nilai Inventori</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card stat-4">
                    <i class="fas fa-tags"></i>
                    <h3><?php echo count($stats['by_category']); ?></h3>
                    <p>Kategori</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <a href="<?php echo BASE_URL; ?>admin/product_create" class="btn btn-primary w-100">
                                    <i class="fas fa-plus"></i> Tambah Produk
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="<?php echo BASE_URL; ?>admin/products" class="btn btn-success w-100">
                                    <i class="fas fa-list"></i> Lihat Semua Produk
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="#" class="btn btn-info w-100">
                                    <i class="fas fa-chart-bar"></i> Laporan
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="#" class="btn btn-warning w-100">
                                    <i class="fas fa-users"></i> Kelola User
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Products -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-history"></i> Produk Terbaru</h5>
                        <a href="<?php echo BASE_URL; ?>admin/products" class="btn btn-sm btn-primary">
                            Lihat Semua <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($recent_products)): ?>
                                    <?php foreach ($recent_products as $product): ?>
                                        <tr>
                                            <td><strong><?php echo htmlspecialchars($product['name']); ?></strong></td>
                                            <td>
                                                <span class="badge badge-category">
                                                    <?php echo htmlspecialchars($product['category']); ?>
                                                </span>
                                            </td>
                                            <td>Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></td>
                                            <td>
                                                <span class="badge <?php echo $product['stock'] > 10 ? 'bg-success' : 'bg-warning'; ?>">
                                                    <?php echo $product['stock']; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d M Y', strtotime($product['created_at'])); ?></td>
                                            <td>
                                                <a href="<?php echo BASE_URL; ?>admin/product_edit/<?php echo $product['id']; ?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?php echo BASE_URL; ?>admin/product_delete/<?php echo $product['id']; ?>"
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('Yakin hapus produk ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada produk</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>


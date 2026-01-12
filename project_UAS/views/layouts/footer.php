        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-spa text-primary"></i> Beauty Store</h5>
                    <p class="text-muted">Toko kosmetik dan skincare online terpercaya. Produk original dengan harga terjangkau.</p>
                </div>
                <div class="col-md-3">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo BASE_URL; ?>user/dashboard" class="text-decoration-none text-muted">Produk</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Kategori</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Tentang Kami</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Kontak</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone"></i> 0812-3456-7890</li>
                        <li><i class="fas fa-envelope"></i> info@beautystore.com</li>
                        <li><i class="fas fa-map-marker-alt"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center text-muted">
                <p>&copy; <?php echo date('Y'); ?> Project UAS Pemrograman Web - Beauty Store. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
    
    <?php if(isset($custom_js)): ?>
        <!-- Page Specific JS -->
        <?php echo $custom_js; ?>
    <?php endif; ?>
</body>
</html>
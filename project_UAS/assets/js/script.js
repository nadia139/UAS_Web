// File: assets/js/script.js

document.addEventListener('DOMContentLoaded', function() {
    
    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
    
    // Confirm delete actions
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const productName = this.getAttribute('data-name') || 'item ini';
            if (!confirm(`Apakah Anda yakin ingin menghapus ${productName}?`)) {
                e.preventDefault();
            }
        });
    });
    
    // Image preview for upload
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    
    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Price formatting
    const priceInputs = document.querySelectorAll('input[type="number"][name="price"]');
    priceInputs.forEach(input => {
        input.addEventListener('input', function() {
            const value = parseFloat(this.value);
            if (value) {
                const formatted = new Intl.NumberFormat('id-ID').format(value);
                const formattedElement = document.getElementById(this.id + 'Formatted');
                if (formattedElement) {
                    formattedElement.textContent = 'Rp ' + formatted;
                }
            }
        });
    });
    
    // Stock validation
    const stockInputs = document.querySelectorAll('input[type="number"][name="stock"]');
    stockInputs.forEach(input => {
        input.addEventListener('input', function() {
            const value = parseInt(this.value);
            if (value < 0) {
                this.value = 0;
                alert('Stok tidak boleh negatif');
            }
        });
    });
    
    // Search with debounce
    let searchTimeout;
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                this.form.submit();
            }, 500);
        });
    }
    
    // Toggle sidebar on mobile
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }
    
    // Format currency display
    const priceElements = document.querySelectorAll('.product-price');
    priceElements.forEach(element => {
        const price = parseFloat(element.textContent.replace(/[^\d]/g, ''));
        if (!isNaN(price)) {
            element.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(price);
        }
    });
    
    // Category filter chips
    const categoryFilters = document.querySelectorAll('.category-filter');
    categoryFilters.forEach(filter => {
        filter.addEventListener('click', function(e) {
            e.preventDefault();
            const category = this.getAttribute('data-category');
            const url = new URL(window.location.href);
            
            if (category === 'all') {
                url.searchParams.delete('category');
            } else {
                url.searchParams.set('category', category);
            }
            url.searchParams.set('page', '1');
            
            window.location.href = url.toString();
        });
    });
});
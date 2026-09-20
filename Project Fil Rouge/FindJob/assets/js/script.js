/* ==========================================================
   FindJob V1 - JavaScript
   ========================================================== */

document.addEventListener('DOMContentLoaded', function () {

    /* ---------- Sidebar Toggle ---------- */
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    if (menuToggle && sidebar && overlay) {
        menuToggle.addEventListener('click', function () {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        });
    }

    /* ---------- Delete Confirmation ---------- */
    document.querySelectorAll('.confirm-delete').forEach(function (link) {
        link.addEventListener('click', function (e) {
            if (!confirm('Voulez-vous vraiment supprimer cet élément ?')) {
                e.preventDefault();
            }
        });
    });

    /* ---------- Active Sidebar Link ---------- */
    const currentPage = window.location.pathname.split('/').pop() || 'index.php';
    document.querySelectorAll('.sidebar-nav a').forEach(function (a) {
        const href = a.getAttribute('href');
        if (href) {
            const page = href.split('/').pop();
            if (page === currentPage) {
                a.classList.add('active');
            }
        }
    });
});

<?php $user = $GLOBALS['user']; ?>

<div class="card p-4 shadow-lg bg-white rounded-4" style="max-width:600px;margin:auto">
    <h3 class="mb-4 text-center">Thông tin tài khoản</h3>

    <!-- 🔥 THÔNG BÁO -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success text-center">
            <?= $_SESSION['success'] ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form method="post" action="index.php?controller=account&action=updateProfile">

        <div class="mb-3">
            <label>Tên đăng nhập</label>
            <input type="text" class="form-control" value="<?= $user->getUser() ?>" disabled>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="<?= $user->getEmail() ?>">
        </div>

        <div class="mb-3">
            <label>SĐT</label>
            <input type="text" name="tel" class="form-control" value="<?= $user->getTel() ?>">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <input type="text" class="form-control" 
                   value="<?= $user->getRole() == 1 ? 'Admin' : 'Người dùng' ?>" disabled>
        </div>

        <button class="btn btn-primary w-100">Cập nhật</button>
    </form>
</div>

<!-- 🔥 AUTO HIDE ALERT -->
<script>
setTimeout(() => {
    let alert = document.querySelector('.alert');
    if (alert) {
        alert.style.transition = "opacity 0.5s";
        alert.style.opacity = "0";
        setTimeout(() => alert.remove(), 500);
    }
}, 3000);
</script>
<?php
require_once 'auth.php';
?>

<aside class="sidebar">

    <div class="logo">
        InventoryPro
    </div>

    <ul>

        <li>
            <a href="index.php"
               class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
                Dashboard
            </a>
        </li>

        <li>
            <a href="report.php"
               class="<?= basename($_SERVER['PHP_SELF']) == 'report.php' ? 'active' : '' ?>">
                Reports
            </a>
        </li>
        <li>
            <a href="logout.php">
                Logout
            </a>
        </li>

    </ul>

    <div class="sidebar-user">

        <div class="username">
            <?= htmlspecialchars(getUsername()) ?>
        </div>

        <div class="role-badge">
            <?= htmlspecialchars($_SESSION['role']) ?>
        </div>

    </div>

</aside>
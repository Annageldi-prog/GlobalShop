<nav class="navbar">
    <div class="container">

        <!-- Logo -->
        <div class="logo">
            <a href="/">GlobalShop</a>
        </div>

        <!-- Menu -->
        <ul class="menu">
            <li><a href="/">Home</a></li>
            <li><a href="#">Men</a></li>
            <li><a href="#">Women</a></li>
            <li><a href="#">Kids</a></li>
            <li><a href="#">Seasons</a></li>
        </ul>

        <!-- Actions -->
        <div class="actions">
            <a href="#">🔍</a>
            <a href="#">🛒 Cart</a>
            <a href="#">👤 Login</a>
        </div>

    </div>
</nav>


<!-- Simple styles (later move to CSS file) -->
<style>
    .navbar {
        background: #111;
        padding: 15px 0;
    }

    .container {
        width: 90%;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo a {
        color: #fff;
        font-size: 22px;
        font-weight: bold;
        text-decoration: none;
    }

    .menu {
        list-style: none;
        display: flex;
        gap: 20px;
    }

    .menu a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
    }

    .menu a:hover {
        color: #f39c12;
    }

    .actions a {
        color: #fff;
        margin-left: 15px;
        text-decoration: none;
    }
</style>

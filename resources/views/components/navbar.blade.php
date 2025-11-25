<nav class="top-navbar">
    <div class="flex align-center">
        <div id="btnside">
            <i class="ri-lg ri-menu-fill trigger"></i>
        </div>
        <div class="logo">
            <h4>Ohayoy</h4>
        </div>
    </div>

    <div class="text-right">
        <h3>{{ Auth::user()->name }}</h3>
        <p class="text-small">{{Auth::user()->role->nama_role}}</p>
    </div>
</nav>

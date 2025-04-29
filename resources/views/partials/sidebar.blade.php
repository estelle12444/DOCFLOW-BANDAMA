<div class="sidebar">
    <div class="text-center mb-3">
        <h4>DOCFLOW-BANDAMA</h4>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }} " href="{{ url('/') }}">
                <i class="fas fa-tachometer-alt"></i> Tableau de bord
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('orders.create') ? 'active' : '' }}" href="{{ route('orders.create') }}">
                <i class="fas fa-plus"></i> Créer un ordre
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('orders.index') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                <i class="fas fa-list"></i> Liste des ordres
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-cogs"></i> Paramètres
            </a>
        </li>
    </ul>
</div>

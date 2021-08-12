<li class="nav-item">
    <a href="{{ route('app\Commands.index') }}"
       class="nav-link {{ Request::is('app\Commands*') ? 'active' : '' }}">
        <p>App\ Commands</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('appCommands.index') }}"
       class="nav-link {{ Request::is('appCommands*') ? 'active' : '' }}">
        <p>App Commands</p>
    </a>
</li>



<li class="nav-item">
    <a href="{{ route('commands.index') }}"
       class="nav-link {{ Request::is('commands*') ? 'active' : '' }}">
        <p>Commands</p>
    </a>
</li>



<li class="nav-item">
    <a href="{{ route('executions.index') }}"
       class="nav-link {{ Request::is('executions*') ? 'active' : '' }}">
        <p>Executions</p>
    </a>
</li>



<nav class="navbar">
    <a href="{{ route('dashboard') }}" class="logo-nav"><img src="{{ asset('images/e-ticket-logo-blanc-on-transparent-background.png') }}" alt="E-Ticket"></a>
    <div class="nav-links">
        <ul>
            <li>
                <a href="{{ route('dashboard') }}" :active="request()->routeIs('/')">
                    Acceuil
                </a>
            </li>
            <li>
                <a href="{{ route('profile.edit', Auth::user()->id) }}">
                    {{ Auth::user()->name }}
                </a>
            </li>
            <li>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Se déconnecter') }}
                    </a>
                </form>
            </li>
        </ul>
    </div>
</nav>
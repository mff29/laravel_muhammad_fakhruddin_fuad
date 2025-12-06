<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
     <div class="container">
          <a class="navbar-brand" href="/">TEST PROGRAMMER FU'AD</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                         <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('rumah-sakit.*') ? 'active' : '' }}" href="{{ route('rumah-sakit.index') }}">Rumah Sakit</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('pasien.*') ? 'active' : '' }}" href="{{ route('pasien.index') }}">Pasien</a>
                    </li>

                    <li class="nav-item">
                    </li>
               </ul>

               <div class="ms-2">
                    @guest
                         <a class="btn btn-outline-primary" href="/login">Login</a>
                    @endguest
                    @auth
                         <form action="{{ route('logout') }}" method="POST" class="d-inline">
                              @csrf
                              <button type="submit" class="btn btn-danger ms-3">
                                   Logout
                              </button>
                         </form>
                    @endauth
               </div>
          </div>
     </div>
</nav>
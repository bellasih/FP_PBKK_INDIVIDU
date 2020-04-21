<!-- Header Content -->
        <!-- Nav tabs -->
        <nav class="navbar navbar-dark navbar-expand-lg fixed-top" style="font-size: 16px; background-color: #6878a0">
            <a class="nav-link text-light" href="{{url()}}">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    {% if session.get('auth') %}
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{url('dashboard')}}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{url('expense')}}">Pengeluaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{url('goods')}}">Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{url('order')}}">Pesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{url('pickup_delivery')}}">Jasa Antar-Jemput</a>
                        </li>
                    {% endif %}
                </ul>
                <ul class="navbar-nav ml-auto">
                    {% if session.get('auth') %}
                        <a class="nav-link text-light" href="{{url('profile')}}">Selamat Datang, <span class="text-info">{{ session.get('auth')['username'] }}</span></a>
                        <a class="nav-link btn btn-danger" href="{{url('logout')}}">Log Out</a>
                    {% else %}
                        <a class="nav-link text-light" href="{{url('login')}}">Log In</a>
                    {% endif %}
                </ul>
            </div>
        </nav>
<!-- END Header Content -->
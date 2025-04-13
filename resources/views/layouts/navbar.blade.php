<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">CABELELEILA LEILA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/bookings">Agendar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/my-bookings">Agendamentos</a>
                </li>
            </ul>
            <span class="navbar-text">
                <form action="/logout" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link" style="display:inline; padding: 0; border: none;">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Sair
                    </button>
                </form>
            </span>
        </div>
    </div>
</nav>

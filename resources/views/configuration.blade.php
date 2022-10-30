@extends('app')

@section('title', 'Configuration')

@section('content_page')
    <ul class="navbar-nav flex-column mt-13 fs-2" id="sideNavbar">
        <li class="nav-item bg-dark d-flex align-items-center flex-column shadow p-3 mb-10 rounded-1">
            <div class="d-flex flex-row align-items-center justify-content-between w-100">
                <div></div>
                <a class="nav-link has-arrow text-white collapsed " href="#!" data-bs-toggle="collapse"
                    data-bs-target="#navConfig" aria-expanded="false" aria-controls="navAuthentication">
                    Configuration d'unité
                </a>
                <i data-feather="chevron-down" class="nav-icon icon me-2" role="button" data-bs-toggle="collapse"
                    data-bs-target="#navConfig" aria-expanded="false" aria-controls="navAuthentication"></i>
            </div>
            <div id="navConfig" class="collapse " data-bs-parent="#sideNavbar">
                <ul class="nav flex-column fs-4">
                    <li class="nav-item">
                        <a class="nav-link text-light-dark" href="{{ route('fournisseur.create') }}"> Ajouter Unité</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light-dark" href="{{ route('fournisseur.index') }}">Liste des Unités</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item bg-dark d-flex align-items-center flex-column shadow p-3 mb-10 rounded-1">
            <div class="d-flex flex-row align-items-center justify-content-between w-100">
                <div></div>
                <a class="nav-link has-arrow text-white collapsed " href="#!" data-bs-toggle="collapse"
                    data-bs-target="#navMarque" aria-expanded="false" aria-controls="navAuthentication">
                    Marque
                </a>
                <i data-feather="chevron-down" class="nav-icon icon me-2 pe-auto" role="button" data-bs-toggle="collapse"
                    data-bs-target="#navMarque" aria-expanded="false" aria-controls="navAuthentication"></i>
            </div>
            <div id="navMarque" class="collapse " data-bs-parent="#sideNavbar">
                <ul class="nav flex-column fs-4">
                    <li class="nav-item">
                        <a class="nav-link text-light-dark" href="{{ route('fournisseur.create') }}"> Ajouter Marque</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light-dark" href="{{ route('fournisseur.index') }}">Liste des Marques</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
@endsection

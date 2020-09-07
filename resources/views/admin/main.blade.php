@extends('layouts.base')

@section('main')

<div class="page">

  <div class="content">

    <div class="container d-flex flex-column">
      <header class="navbar navbar-expand-md pb-2 border-bottom row">
          <div class="container-xl">
            
            <a href="/" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pr-0 pr-md-3">
              <img src="/static/logo.svg" alt="Tabler" class="navbar-brand-image">
            </a>

            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
                <span class="avatar" style="background-image: url(./static/avatars/000m.jpg)"></span>
                <div class="d-none d-xl-block pl-2">
                  <div>Paweł Kuna</div>
                  <div class="mt-1 small text-muted">UI Designer</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><circle cx="12" cy="12" r="3" /></svg>
                  Action
                </a>
                <a class="dropdown-item" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                  Another action
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                  Separated link</a>
              </div>
            </div>

          </div>
      </header>

  
      <div class="row mt-4 flex-grow-1">

        <div class="col-md-2">

          <div>
            
              <div class="list-group list-group-transparent mb-0">

                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center active">
                  <span class="icon mr-3 mb-2">
                    <i class="fas fa-laptop"></i>
                  </span>
                  Dashboard
                </a>

                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                  <span class="icon mr-3 mb-2">
                    <i class="far fa-file-alt"></i>
                  </span>
                  Pelajaran
                </a>

                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                  <span class="icon mr-3 mb-2">
                    <i class="fas fa-pen-alt"></i>
                  </span>
                  Ujian
                </a>

                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                  <span class="icon mr-3 mb-2">
                    <i class="fas fa-user"></i>
                  </span>
                  User
                </a>

                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                  <span class="icon mr-3 mb-2">
                    <i class="fas fa-cogs"></i>
                  </span>
                  Pengaturan
                </a>

              </div>

          </div>


        </div>

        <div class="col-md-10">

          <div class="container pt-2 pl-4">

            @yield('content')

          </div>

        </div>
      
      </div>
  
    </div>

    <footer class="footer footer-transparent flex-shrink-0">
      <div class="container">
        <div class="row text-center align-items-center flex-row-reverse">
          <div class="col-lg-auto ml-lg-auto">
            <ul class="list-inline list-inline-dots mb-0">
              <li class="list-inline-item"><a href="./docs/index.html" class="link-secondary">Documentation</a></li>
              <li class="list-inline-item"><a href="./faq.html" class="link-secondary">FAQ</a></li>
              <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank" class="link-secondary">Source code</a></li>
            </ul>
          </div>
          <div class="col-12 col-lg-auto mt-3 mt-lg-0">
            Copyright © 2020
            <a href="." class="link-secondary">Tabler</a>.
            All rights reserved.
          </div>
        </div>
      </div>
    </footer>

  </div>

</div>

@endsection

@section('js')
    <!-- Libs JS -->
    <script src="/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js"></script>
@endsection
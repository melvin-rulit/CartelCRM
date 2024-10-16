@extends('layouts.guest')

@section('content')

    <section class="login-section">
        <div class="form-container">
            <div class="row">
                <div class="col-12">
                    <h1 class="heading text-center">Вход в <b>CRM</b> систему <b>Cartel</b></h1>

                    <!-- Форма -->
                    <form id="loginForm" action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="name@Email адрес" required />
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Пароль" required />
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Войти
                        </button>
                    </form>

                    <div id="errors" class="alert alert-danger" style="display: none;">
                        <ul id="error-list"></ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

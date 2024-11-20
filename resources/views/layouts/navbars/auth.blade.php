<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
            {{ __('Manajemen Risiko TI') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard.index', 'dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'risk' || $elementActive == 'mitigation' || $elementActive == 'evaluate' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                        {{ __('Risk Management') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'risk' ? 'active' : '' }}">
                            <a href="{{ route('kelemahan.index') }}">
                                <i class="fas fa-exclamation-triangle"></i>
                                <p>{{ __('Risk List') }}</p>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'evaluate' ? 'active' : '' }}">
                            <a href="{{ route('risks.index') }}">
                                <i class="nc-icon nc-alert-circle-i"></i>
                                <p>{{ __('Risk Evaluation') }}</p>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'mitigation' ? 'active' : '' }}">
                            <a href="{{ route('mitigations.index') }}">
                                <i class="fas fa-clipboard-list"></i>
                                <p>{{ __('Risk Mitigation') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples2">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                        {{ __('User Management') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExamples2">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}">
                                <i class="fas fa-users"></i> <!-- Font Awesome Users Icon -->
                                <p>{{ __('User List') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
      <!-- Sidebar Start -->
      <div class="sidebar pe-4 pb-3" >
        <nav class="navbar bg-secondary navbar-dark">
            <a href="{{ route('dashboard.index') }}" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Med-Rep</h3>
            </a>
<div class="navbar-nav w-100">
            <a href="{{ route('dashboard.index') }}" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>{{ __('locale.dashboard') }}</a>
            @can('view_users')

             <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-users"></i>{{ __('locale.users') }}</a>
                <div class="dropdown-menu bg-transparent border-0">
                      <a href="{{ route('delegateSupervisor.index') }}" class="nav-item nav-link" style="size: 20px" ><i class="fas fa-user-plus"></i>{{ __('locale.delegate_supervisor') }}</a>
                      <a href="{{ route('delegate.index') }}" class="nav-item nav-link" ><i class="fas fa-user-plus"></i>{{ __('locale.delegate') }}</a>
                      <a href="{{ route('roles.index') }}" class="dropdown-item"><i class="fas fa-user-cog" ></i>{{ __('locale.user-permissions') }}</a>

                </div>
             </div>
            @endcan

                @can('view_city')
                <a href="{{ route('city.index') }}" class="nav-item nav-link" ><i class="fa-duotone fa-solid fa-location-dot"></i>{{ __('locale.city') }}</a>
                @endcan
                @can('view_doctor')
                <a href="{{ route('doctor.index') }}" class="nav-item nav-link" ><i class="fa-solid fa-user-doctor"></i>{{ __('locale.doctor') }}</a>
                @endcan
                @can('view_visti')
                <a href="{{ route('visit.index') }}" class="nav-item nav-link" ><i class="fa-solid fa-user-doctor"></i>{{ __('locale.visit') }}</a>
                @endcan
                @can('view_company')
                <a href="{{ route('company.index') }}" class="nav-item nav-link" ><i class="fa-solid fa-user-doctor"></i>{{ __('locale.company') }}</a>
                @endcan
                @can('view_sample')
                <a href="{{ route('sample.index') }}" class="nav-item nav-link" ><i class="fa-solid fa-user-doctor"></i>{{ __('locale.sample') }}</a>
                @endcan
                @can('view_region')
                <a href="{{ route('region.index') }}" class="nav-item nav-link" ><i class="fa-solid fa-user-doctor"></i>{{ __('locale.region') }}</a>
                @endcan
                @can('view_ticket')
                <a href="{{ route('tickets.index') }}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>{{ __('locale.ticket') }}</a>
                @endcan


            </div>
        </nav>
    </div>
    <!-- Sidebar End -->

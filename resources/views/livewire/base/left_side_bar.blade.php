<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            @if(auth()->user()->user_type === 'cashier')

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Sell</li>
                
                <li>
                    <a href="{{ route('customer') }}">
                        <i class="dripicons-user-group"></i>
                        <span> Customers </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('make_sell') }}">
                        <i class="dripicons-cart"></i>
                        <span> Make Sell </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('sell_record') }}">
                        <i class="fas fa-file-alt"></i>
                        <span> Sell Record </span>
                    </a>
                </li>

            </ul>

            @elseif(auth()->user()->user_type === 'manager')

                @include('livewire.base.sidebar_pertials.for_manager')

            @else

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="dripicons-meter"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title">Inventory</li>

                <li>
                    <a href="{{ route('category') }}">
                        <i class="fas fa-th"></i>
                        <span> Category </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('products') }}">
                        <i class="dripicons-box"></i>
                        <span> Products </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('suppliers') }}">
                        <i class="fas fa-truck-moving"></i>
                        <span> Suppliers </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('make_purchase') }}">
                        <i class="dripicons-clipboard"></i>
                        <span> Product Purchase </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('purchase') }}">
                        <i class="dripicons-checklist"></i>
                        <span> Purchase List </span>
                    </a>
                </li>

                <li class="menu-title">Sell</li>
                
                <li>
                    <a href="{{ route('customer') }}">
                        <i class="dripicons-user-group"></i>
                        <span> Customers </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('make_sell') }}">
                        <i class="dripicons-cart"></i>
                        <span> Make Sell </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('sell_record') }}">
                        <i class="fas fa-file-alt"></i>
                        <span> Sell Record </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('refund') }}">
                        <i class="fas fa-money-bill-alt"></i>
                        <span> Refund </span>
                    </a>
                </li>

                <li class="menu-title">Expenses</li>

                <li>
                    <a href="{{ route('expences') }}">
                        <i class="fas fa-money-bill-alt"></i>
                        <span> Expenses </span>
                    </a>
                </li>

                <li class="menu-title">Report</li>
                
                <li>
                    <a href="{{ route('profit') }}">
                        <i class="mdi mdi-cash"></i>
                        <span> Profit </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('report') }}">
                        <i class="icon-graph"></i>
                        <span> Report </span>
                    </a>
                </li>

                <li class="menu-title">Configuration</li>

                <li>
                    <a href="{{ route('payment') }}">
                        <i class="fas fa-coins"></i>
                        <span> Payment Method </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user') }}">
                        <i class="fas fa-user"></i>
                        <span> Users </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('configuration') }}">
                        <i class="fas fa-tools"></i>
                        <span> Configuration </span>
                    </a>
                </li>

            </ul>

            @endif

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
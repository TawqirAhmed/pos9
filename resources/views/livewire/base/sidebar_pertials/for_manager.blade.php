<ul class="metismenu" id="side-menu">

    <li class="menu-title">Navigation</li>


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

    

</ul>
<div class="left-side-bar">
  <div class="brand-logo">
    <a href="index.html">
      {{-- <img src="{{ url('assets/src/images/Group5.png') }}" alt="" class="dark-logo" /> --}}
      <img
        src="{{ url('assets/src/images/Group5.png') }}"
        alt=""
        style="margin-top:auto;margin-left:50px;"
        class="light-logo"
      />
    </a>
    <div class="close-sidebar" data-toggle="left-sidebar-close">
      <i class="ion-close-round"></i>
    </div>
  </div>
  <div class="menu-block customscroll" style="margin-top:40px;">
    <div class="sidebar-menu">
     <ul id="accordion-menu">
        <li>
          <a href="{{route('admin.dashboard')}}" class="dropdown-toggle no-arrow {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <span class="micon bi bi-house"></span><span class="mtext">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.category')}}" class="dropdown-toggle no-arrow">
            <span class="micon dw dw-user1"></span><span class="mtext">Category</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.orders')}}" class="dropdown-toggle no-arrow">
            <span class="micon dw dw-user1"></span><span class="mtext">Orders</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.product')}}" class="dropdown-toggle no-arrow">
            <span class="micon dw dw-user1"></span><span class="mtext">Products</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.payment-history')}}" class="dropdown-toggle no-arrow">
            <span class="micon dw dw-user1"></span><span class="mtext">Payment History</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
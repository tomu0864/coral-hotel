<div class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
    </div>
    <div>
      <h4 class="logo-text">CORAL</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
    </div>
   </div>
  <!--navigation-->
  <ul class="metismenu" id="menu">

    <li>
      <a href="{{ route('admin.dashboard') }}">
        <div class="parent-icon"><i class='bx bx-home-alt'></i>
        </div>
        <div class="menu-title">Dashboard</div>
      </a>
    </li>

    {{-- @if (Auth::user()->can('team.menu')) --}}
      
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-group"></i>
        </div>
        <div class="menu-title">Team</div>
      </a>
      <ul>
        <li> <a href="{{ route('team.all') }}"><i class='bx bxs-user-detail'></i>List</a>
        </li>
        <li> <a href="{{ route('team.add') }}"><i class='bx bx-user-plus'></i>Add</a>
        </li>
      </ul>
    </li>

    {{-- @endif --}}

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-message-dots'></i>
        </div>
        <div class="menu-title">Testimonials</div>
      </a>
      <ul>
        <li> <a href="{{ route('testimonial.all') }}"><i class='bx bx-list-ul'></i>List</a>
        </li>
        <li> <a href="{{ route('testimonial.add') }}"><i class='bx bx-comment-add'></i></i>Add</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bxl-blogger'></i>
        </div>
        <div class="menu-title">Blogs</div>
      </a>
      <ul>
        <li> <a href="{{ route('blog.category') }}"><i class='bx bx-category'></i>Category</a>
        </li>
        <li> <a href="{{ route('blog.post.all') }}"><i class='bx bx-pencil'></i>Post</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-comment'></i>
        </div>
        <div class="menu-title">Comments</div>
      </a>
      <ul>
        <li> <a href="{{ route('comment.all') }}"><i class='bx bx-comment-detail'></i>List</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-question-mark'></i>
        </div>
        <div class="menu-title">FAQ</div>
      </a>
      <ul>
        <li> <a href="{{ route('faq.all') }}"><i class='bx bx-list-ul'></i>List</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-images'></i>
        </div>
        <div class="menu-title">Gallery</div>
      </a>
      <ul>
        <li> <a href="{{ route('gallery.all') }}"><i class='bx bx-list-ul'></i>List</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-restaurant'></i>
        </div>
        <div class="menu-title">Restaurant</div>
      </a>
      <ul>
        <li> <a href="{{ route('restaurant.category.all') }}"><i class='bx bx-category-alt'></i>Category</a>
        </li>
        <li> <a href="{{ route('restaurant.menu.all') }}"><i class='bx bx-food-menu'></i>Menu</a>
        </li>
      </ul>
    </li>

    
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-category"></i>
        </div>
        <div class="menu-title">Book Area</div>
      </a>
      <ul>
        <li> <a href="{{ route('book.area') }}"><i class='bx bx-edit'></i>Update Book Area</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-bath"></i>
        </div>
        <div class="menu-title">Facilities</div>
      </a>
      <ul>
        <li> <a href="{{ route('facility.list') }}"><i class='bx bx-list-ul'></i>List</a>
        </li>
        <li> <a href="{{ route('facility.create') }}"><i class='bx bx-list-plus'></i>Add</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-bed"></i>
        </div>
        <div class="menu-title">Room Types</div>
      </a>
      <ul>
        <li> <a href="{{ route('room.type.list') }}"><i class='bx bx-list-ul'></i>List</a>
        </li>
        <li> <a href="{{ route('room.type.add') }}"><i class='bx bx-list-plus'></i>Add</a>
        </li>
      </ul>
    </li>

    <li class="menu-label">Bookings</li>
   
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-calendar'></i>
        </div>
        <div class="menu-title">Bookings</div>
      </a>
      <ul>
        <li> <a href="{{ route('booking.list') }}"><i class='bx bx-calendar-week'></i>Ongoing Bookings</a>
        </li>

        <li> <a href="{{ route('booking.history') }}"><i class='bx bx-calendar-check'></i>History</a>
        </li>
        <li> <a href="{{ route('booking.room.list.add') }}"><i class='bx bx-calendar-plus'></i>Add</a>
        </li>
        <li> <a href="{{ route('booking.report') }}"><i class='bx bxs-report'></i>Report</a>
        </li>
      </ul>
    </li>
    
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-door-open' ></i>
        </div>
        <div class="menu-title">Rooms</div>
      </a>
      <ul>
        <li> <a href="{{route('roomnumber.show') }}"><i class='bx bx-list-ul'></i>List</a>
        </li>
      </ul>
    </li>
    
    <li class="menu-label">Settings</li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-envelope"></i>
        </div>
        <div class="menu-title">Mail</div>
      </a>
      <ul>
        <li> <a href="{{ route('setting.smtp') }}"><i class='bx bx-cog'></i>SMTP</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="{{ route('setting.site') }}">
        <div class="parent-icon"><i class='bx bx-globe'></i>
        </div>
        <div class="menu-title">Site</div>
      </a>
    </li>

    <li>
      <a href="{{ route('policy.edit') }}">
        <div class="parent-icon"><i class='bx bx-check-shield'></i>
        </div>
        <div class="menu-title">Privacy Policy</div>
      </a>
    </li>

    <li>
      <a href="{{ route('term.edit') }}">
        <div class="parent-icon"><i class='bx bxs-file-doc'></i>
        </div>
        <div class="menu-title">Terms & Conditions</div>
      </a>
    </li>

    <li class="menu-label">Role & Permission</li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-key'></i>
        </div>
        <div class="menu-title">Role & Permission</div>
      </a>
      <ul>
        <li> 
          <a href="{{ route('role.permission') }}"><i class='bx bxs-key'></i>Permissions</a>
        </li>

        <li> 
          <a href="{{ route('role.all') }}"><i class='bx bx-message-rounded-dots'></i>Roles</a>
        </li>

        <li> 
          <a href="{{ route('role.permission.assign') }}"><i class='bx bxs-user-plus'></i>Assign Role In Permission</a>
        </li>

        <li> 
          <a href="{{ route('role.permission.assign.all') }}"><i class='bx bxs-user-detail'></i>All Role In Permission</a>
        </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-user-check'></i>
        </div>
        <div class="menu-title">Admin User</div>
      </a>
      <ul>
        <li> 
          <a href="{{ route('admin.all') }}"><i class='bx bxs-user-detail'></i>All Admin</a>
        </li>

        <li> 
          <a href="{{ route('admin.add') }}"><i class='bx bxs-user-plus'></i>Add Admin</a>
        </li>

      </ul>
    </li>

    <li class="menu-label">Support</li>

    <li>
      <a href="{{ route('contact.message') }}">
        <div class="parent-icon"><i class='bx bx-message-rounded-dots'></i>
        </div>
        <div class="menu-title">Contact Message</div>
      </a>
    </li>
  <!--end navigation-->
</div>
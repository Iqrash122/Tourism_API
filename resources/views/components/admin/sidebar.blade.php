<aside
  :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
  class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0">
  <!-- SIDEBAR HEADER -->
  <div
    :class="sidebarToggle ? 'justify-center' : 'justify-between'"
    class="flex items-center gap-2 pt-8 sidebar-header pb-7">
    <a href="/admin">
      <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
        <span class="dark:text-white font-bold uppercase">Tourism Dashboard</span>
        {{-- <img class="dark:hidden" src="./images/logo/logo.svg" alt="Logo" />
        <img
          class="hidden dark:block"
          src="./images/logo/logo-dark.svg"
          alt="Logo" /> --}}
      </span>

      <img
        class="logo-icon"
        :class="sidebarToggle ? 'lg:block' : 'hidden'"
        src="./images/logo/logo-icon.svg"
        alt="Logo" />
    </a>
  </div>
  <!-- SIDEBAR HEADER -->

  <div
    class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
    <!-- Sidebar Menu -->
    <nav x-data="{selected: $persist('Dashboard')}">
      <!-- Menu Group -->
      <div>

        <ul class="flex flex-col gap-4 mb-6">
          <!-- Menu Item Dashboard -->
          <li>
            <a
              href="{{url('/')}}"
              class="menu-item group"
              :class="(page === 'ecommerce' || page === 'analytics' || page === 'marketing' || page === 'crm' || page === 'stocks') ? 'menu-item-active' : 'menu-item-inactive'">

              <svg
                :class="(page === 'ecommerce' || page === 'analytics' || page === 'marketing' || page === 'crm' || page === 'stocks') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V9C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 9V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V9C9.75 9.41421 9.41421 9.75 9 9.75H5.5C5.08579 9.75 4.75 9.41421 4.75 9V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7426 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V9C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 9V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V9C14.25 9.41421 14.5858 9.75 15 9.75H18.5C18.9142 9.75 19.25 9.41421 19.25 9V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7426 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                  fill="" />
              </svg>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''">
                Dashboard
              </span>
            </a>
          </li>




          <!-- Menu Item Tourism -->
          <li>
            <a
              href="#"
              @click.prevent="selected = (selected === 'Forms' ? '':'Forms')"
              class="menu-item group"
              :class=" (selected === 'Forms') || (page === 'formElements' || page === 'formLayout' || page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-active' : 'menu-item-inactive'">
              <svg
                :class="(selected === 'Forms') || (page === 'formElements' || page === 'formLayout' || page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H18.5001C19.7427 20.75 20.7501 19.7426 20.7501 18.5V5.5C20.7501 4.25736 19.7427 3.25 18.5001 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H18.5001C18.9143 4.75 19.2501 5.08579 19.2501 5.5V18.5C19.2501 18.9142 18.9143 19.25 18.5001 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V5.5ZM6.25005 9.7143C6.25005 9.30008 6.58583 8.9643 7.00005 8.9643L17 8.96429C17.4143 8.96429 17.75 9.30008 17.75 9.71429C17.75 10.1285 17.4143 10.4643 17 10.4643L7.00005 10.4643C6.58583 10.4643 6.25005 10.1285 6.25005 9.7143ZM6.25005 14.2857C6.25005 13.8715 6.58583 13.5357 7.00005 13.5357H17C17.4143 13.5357 17.75 13.8715 17.75 14.2857C17.75 14.6999 17.4143 15.0357 17 15.0357H7.00005C6.58583 15.0357 6.25005 14.6999 6.25005 14.2857Z"
                  fill="" />
              </svg>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''">
                Tourism
              </span>

              <svg
                class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                :class="[(selected === 'Forms') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585"
                  stroke=""
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </a>

            <!-- Dropdown Menu Start -->
            <div
              class="overflow-hidden transform translate"
              :class="(selected === 'Forms') ? 'block' :'hidden'">
              <ul
                :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                <li>
                  <a
                    href="{{route('tourism.index')}}"
                    class="menu-dropdown-item group"
                    :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                    All Tours
                  </a>
                </li>

                <li>
                  <a
                    href="{{route('tourism.create')}}"
                    class="menu-dropdown-item group"
                    :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                    Add New
                  </a>
                </li>


                <li>
                  <a
                    href="{{route('category.index')}}"
                    class="menu-dropdown-item group"
                    :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                    Categories
                  </a>
                </li>


                <li>
                  <a
                    href="{{route('cities.index')}}"
                    class="menu-dropdown-item group"
                    :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                    Cities
                  </a>
                </li>
              </ul>
            </div>
            <!-- Dropdown Menu End -->
          </li>


          <!-- Menu Item Book Tours -->
          <li>
            <a
              href="#"
              @click.prevent="selected = (selected === 'Tables' ? '':'Tables')"
              class="menu-item group"
              :class="(selected === 'Tables') || (page === 'basicTables' || page === 'dataTables') ? 'menu-item-active' : 'menu-item-inactive'">
              <svg
                :class="(selected === 'Tables') || (page === 'basicTables' || page === 'dataTables') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M3.25 5.5C3.25 4.25736 4.25736 3.25 5.5 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V18.5C20.75 19.7426 19.7426 20.75 18.5 20.75H5.5C4.25736 20.75 3.25 19.7426 3.25 18.5V5.5ZM5.5 4.75C5.08579 4.75 4.75 5.08579 4.75 5.5V8.58325L19.25 8.58325V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H5.5ZM19.25 10.0833H15.416V13.9165H19.25V10.0833ZM13.916 10.0833L10.083 10.0833V13.9165L13.916 13.9165V10.0833ZM8.58301 10.0833H4.75V13.9165H8.58301V10.0833ZM4.75 18.5V15.4165H8.58301V19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5ZM10.083 19.25V15.4165L13.916 15.4165V19.25H10.083ZM15.416 19.25V15.4165H19.25V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15.416Z"
                  fill="" />
              </svg>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''">
                Book Tours
              </span>

              <svg
                class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                :class="[(selected === 'Tables') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585"
                  stroke=""
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </a>

            <!-- Dropdown Menu Start -->
            <div
              class="overflow-hidden transform translate"
              :class="(selected === 'Tables') ? 'block' :'hidden'">
              <ul
                :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                <li>
                  <a
                    href="{{route('book_tour.index')}}"
                    class="menu-dropdown-item group"
                    :class="page === 'basicTables' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                    All Bookings
                  </a>
                </li>

                <li>
                  <a
                    href="{{route('book_tour.create')}}"
                    class="menu-dropdown-item group"
                    :class="page === 'basicTables' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                    Add New
                  </a>
                </li>
              </ul>
            </div>
            <!-- Dropdown Menu End -->
          </li>


          <!-- Menu Item Customers -->
          <li>
            <a
              href="#"
              @click.prevent="selected = (selected === 'Pages' ? '':'Pages')"
              class="menu-item group"
              :class="(selected === 'Pages') || (page === 'fileManager' || page === 'pricingTables' || page === 'blank' || page === 'page404' || page === 'page500' || page === 'page503' || page === 'success' || page === 'faq' || page === 'comingSoon' || page === 'maintenance') ? 'menu-item-active' : 'menu-item-inactive'">
              <svg
                :class="(selected === 'Pages') || (page === 'fileManager' || page === 'pricingTables' || page === 'blank' || page === 'page404' || page === 'page500' || page === 'page503' || page === 'success' || page === 'faq' || page === 'comingSoon' || page === 'maintenance') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M8.50391 4.25C8.50391 3.83579 8.83969 3.5 9.25391 3.5H15.2777C15.4766 3.5 15.6674 3.57902 15.8081 3.71967L18.2807 6.19234C18.4214 6.333 18.5004 6.52376 18.5004 6.72268V16.75C18.5004 17.1642 18.1646 17.5 17.7504 17.5H16.248V17.4993H14.748V17.5H9.25391C8.83969 17.5 8.50391 17.1642 8.50391 16.75V4.25ZM14.748 19H9.25391C8.01126 19 7.00391 17.9926 7.00391 16.75V6.49854H6.24805C5.83383 6.49854 5.49805 6.83432 5.49805 7.24854V19.75C5.49805 20.1642 5.83383 20.5 6.24805 20.5H13.998C14.4123 20.5 14.748 20.1642 14.748 19.75L14.748 19ZM7.00391 4.99854V4.25C7.00391 3.00736 8.01127 2 9.25391 2H15.2777C15.8745 2 16.4468 2.23705 16.8687 2.659L19.3414 5.13168C19.7634 5.55364 20.0004 6.12594 20.0004 6.72268V16.75C20.0004 17.9926 18.9931 19 17.7504 19H16.248L16.248 19.75C16.248 20.9926 15.2407 22 13.998 22H6.24805C5.00541 22 3.99805 20.9926 3.99805 19.75V7.24854C3.99805 6.00589 5.00541 4.99854 6.24805 4.99854H7.00391Z"
                  fill="" />
              </svg>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''">
                Customers
              </span>

              <svg
                class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                :class="[(selected === 'Pages') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585"
                  stroke=""
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </a>


            <div
              class="overflow-hidden transform translate"
              :class="(selected === 'Pages') ? 'block' :'hidden'">
              <ul
                :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                <li>
                  <a
                    href="{{route('customer.index')}}"
                    class="menu-dropdown-item group"
                    :class="page === 'blank' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                    All Customers
                  </a>
                </li>
                <li>
                  <a
                    href="{{route('customer.create')}}"
                    class="menu-dropdown-item group"
                    :class="page === 'page404' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                    Add New
                  </a>
                </li>
              </ul>
            </div>

          </li>

        </ul>
      </div>


      <!-- Menu Item Users and setting -->
      <div>
        <ul class="flex flex-col gap-4 mb-6">

          <!-- Menu Item Users -->

          <li>
            <a
              href="#"
              @click.prevent="selected = (selected === 'Charts' ? '':'Charts')"
              class="menu-item group"
              :class="(selected === 'Charts') || (page === 'lineChart' || page === 'barChart' || page === 'pieChart') ? 'menu-item-active' : 'menu-item-inactive'">
              <svg
                :class="(selected === 'Charts') || (page === 'lineChart' || page === 'barChart' || page === 'pieChart') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M12 2C11.5858 2 11.25 2.33579 11.25 2.75V12C11.25 12.4142 11.5858 12.75 12 12.75H21.25C21.6642 12.75 22 12.4142 22 12C22 6.47715 17.5228 2 12 2ZM12.75 11.25V3.53263C13.2645 3.57761 13.7659 3.66843 14.25 3.80098V3.80099C15.6929 4.19606 16.9827 4.96184 18.0104 5.98959C19.0382 7.01734 19.8039 8.30707 20.199 9.75C20.3316 10.2341 20.4224 10.7355 20.4674 11.25H12.75ZM2 12C2 7.25083 5.31065 3.27489 9.75 2.25415V3.80099C6.14748 4.78734 3.5 8.0845 3.5 12C3.5 16.6944 7.30558 20.5 12 20.5C15.9155 20.5 19.2127 17.8525 20.199 14.25H21.7459C20.7251 18.6894 16.7492 22 12 22C6.47715 22 2 17.5229 2 12Z"
                  fill="" />
              </svg>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''">
                Users
              </span>

              <svg
                class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                :class="[(selected === 'Charts') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585"
                  stroke=""
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </a>

            <!-- Dropdown Menu Start -->
            <div
              class="overflow-hidden transform translate"
              :class="(selected === 'Charts') ? 'block' :'hidden'">
              <ul
                :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                <li>
                  <a
                    href="{{route('users.index')}}"
                    class="menu-dropdown-item group"
                    :class="page === 'lineChart' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                    All Users
                  </a>
                </li>

              </ul>
            </div>
            <!-- Dropdown Menu End -->
          </li>


          <!-- Menu Item Ui Settings -->
          <li>
            <a
              href="#"
              @click.prevent="selected = (selected === 'UIElements' ? '':'UIElements')"
              class="menu-item group"
              :class="(selected === 'UIElements') || (page === 'alerts' || page === 'avatars' || page === 'badge' || page === 'buttons' || page === 'buttonsGroup' || page === 'cards'|| page === 'carousel' || page === 'dropdowns' || page === 'images' || page === 'list' || page === 'modals' || page === 'videos') ? 'menu-item-active' : 'menu-item-inactive'">
              <svg
                :class="(selected === 'UIElements') || (page === 'alerts' || page === 'avatars' || page === 'badge' || page === 'breadcrumb' || page === 'buttons' || page === 'buttonsGroup' || page === 'cards'|| page === 'carousel' || page === 'dropdowns' || page === 'images' || page === 'list' || page === 'modals' || page === 'notifications' || page === 'popovers' || page === 'progress' || page === 'spinners' || page === 'tooltips' || page === 'videos') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M11.665 3.75618C11.8762 3.65061 12.1247 3.65061 12.3358 3.75618L18.7807 6.97853L12.3358 10.2009C12.1247 10.3064 11.8762 10.3064 11.665 10.2009L5.22014 6.97853L11.665 3.75618ZM4.29297 8.19199V16.0946C4.29297 16.3787 4.45347 16.6384 4.70757 16.7654L11.25 20.0365V11.6512C11.1631 11.6205 11.0777 11.5843 10.9942 11.5425L4.29297 8.19199ZM12.75 20.037L19.2933 16.7654C19.5474 16.6384 19.7079 16.3787 19.7079 16.0946V8.19199L13.0066 11.5425C12.9229 11.5844 12.8372 11.6207 12.75 11.6515V20.037ZM13.0066 2.41453C12.3732 2.09783 11.6277 2.09783 10.9942 2.41453L4.03676 5.89316C3.27449 6.27429 2.79297 7.05339 2.79297 7.90563V16.0946C2.79297 16.9468 3.27448 17.7259 4.03676 18.1071L10.9942 21.5857L11.3296 20.9149L10.9942 21.5857C11.6277 21.9024 12.3732 21.9024 13.0066 21.5857L19.9641 18.1071C20.7264 17.7259 21.2079 16.9468 21.2079 16.0946V7.90563C21.2079 7.05339 20.7264 6.27429 19.9641 5.89316L13.0066 2.41453Z"
                  fill="" />
              </svg>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''">
                Settings
              </span>

              <svg
                class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                :class="[(selected === 'UIElements') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585"
                  stroke=""
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </a>

            <!-- Dropdown Menu Start -->
            <div
              class="overflow-hidden transform translate"
              :class="(selected === 'UIElements') ? 'block' :'hidden'">
              <ul
                :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                <!-- <li>
                  <a
                    href="{{route('settings.account')}}"
                    class="menu-dropdown-item group"
                    :class="page === 'alerts' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                    Account
                  </a>
                </li> -->
                <li>
                  <a
                    href="{{route('settings.currency')}}"
                    class="menu-dropdown-item group"
                    :class="page === 'avatars' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                    Currency
                  </a>
                </li>

              </ul>
            </div>
            <!-- Dropdown Menu End -->
          </li>

          <!-- Menu Item Authentication -->

            <!-- Menu Item Support -->
            <li>
            <a
              href="#"
              @click.prevent="selected = (selected === 'Support' ? '' : 'Support')"
              class="menu-item group"
              :class="(selected === 'Support') ? 'menu-item-active' : 'menu-item-inactive'">
              <svg
              :class="(selected === 'Support') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M12 2C6.477 2 2 6.477 2 12c0 5.523 4.477 10 10 10s10-4.477 10-10c0-5.523-4.477-10-10-10zm0 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16zm-.75-7.5a.75.75 0 0 1 1.5 0v.25c0 .414-.336.75-.75.75s-.75-.336-.75-.75v-.25zm0-5a.75.75 0 0 1 1.5 0c0 1.25-.75 2-2 2-.414 0-.75.336-.75.75s.336.75.75.75c1.657 0 3-1.343 3-3a2.75 2.75 0 0 0-5.5 0c0 1.657 1.343 3 3 3z"
                fill="currentColor"/>
              </svg>
              <span
              class="menu-item-text"
              :class="sidebarToggle ? 'lg:hidden' : ''">
              Support
              </span>
              <svg
              class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
              :class="[(selected === 'Support') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
              width="20"
              height="20"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585"
                stroke=""
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round" />
              </svg>
            </a>
            <!-- Dropdown Menu Start -->
            <div
              class="overflow-hidden transform translate"
              :class="(selected === 'Support') ? 'block' :'hidden'">
              <ul
              :class="sidebarToggle ? 'lg:hidden' : 'flex'"
              class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
              <li>
                <a
                href="{{route('support.index')}}"
                class="menu-dropdown-item group"
                :class="page === 'support' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                All Queries
                </a>
              </li>
             
              </ul>
            </div>
            <!-- Dropdown Menu End -->
            </li>
        </ul>
      </div>
    </nav>

  </div>
</aside>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="dashboard.php" class="brand-link">

        <span class="brand-text font-weight-light">CEC | Admin </span>
      </a>
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

          <!-- picture logo here -->
          <!-- picture logo here -->

          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['uname']; ?></a>
          </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>



            <!--Manage Admin--->
            <!-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                <p>
                  Manage Admin
                </p>
              </a>
            </li> -->

            <!--Manage Students--->
            <li class="nav-item">
              <a href="manage-student.php" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                <p>
                  Manage Students
                </p>
              </a>
            </li>

            <!-- Manage Registrar--->
            <li class="nav-item">
              <a href="manage-registrar.php" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                <p>
                  Manage Registrar
                </p>
              </a>  
            </li>



            <!--Profile--->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                  Account Settings
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="profile.php" class="nav-link">
                    <i class="far fa-user nav-icon"></i>
                    <p>Profile</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="change-password.php" class="nav-link">
                    <i class="fas fa-cog nav-icon"></i>
                    <p>Change Password</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="logout.php" class="nav-link">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
                    <p>Logout</p>
                  </a>
                </li>

              </ul>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
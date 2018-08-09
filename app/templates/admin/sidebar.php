 <!-- Left Sidebar  -->
 <div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label"><?= @$text_home ?></li>
                <li> 
                    <a href="/" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu"><?= @$text_dashboard ?></span></a>
                </li>
                <li class="nav-label"><?= @$text_users_privileges ?></li>
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu"><?= @$text_users ?></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="/users"><?= @$text_users ?></a></li>
                        <li><a href="/usersgroups"><?= @$text_users_groups ?></a></li>
                        <li><a href="/usersprivileges"><?= @$text_usersprivileges ?></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>
<!-- End Left Sidebar  -->
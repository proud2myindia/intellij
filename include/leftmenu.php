

<!-- =================================================
================= CONTROLS Content ===================
================================================== -->
<div id="controls">





    <!-- ================================================
    ================= SIDEBAR Content ===================
    ================================================= -->
    <aside id="sidebar">


        <div id="sidebar-wrap">

            <div class="panel-group slim-scroll" role="tablist">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#sidebarNav">
                                Navigation <i class="fa fa-angle-up"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                        <div class="panel-body">


                            <!-- ===================================================
                            ================= NAVIGATION Content ===================
                            ==================================================== -->
                            <ul id="navigation">
                                <li class="active"><a href="dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                <?php
                                if($_SESSION['user_id'] == 0)
                                {
                                    ?>
                                    <li>
                                        <a role="button" tabindex="0"><i class="fa fa-delicious"></i> <span>User Management</span></a>
                                        <ul>
                                            <li><a href="user_listing"><i class="fa fa-caret-right"></i> All User</a></li>

                                        </ul>
                                    </li>
                                <?php
                                }

                                ?>

                                <li>
                                    <a role="button" tabindex="0"><i class="fa fa-delicious"></i> <span>Task Management</span></a>
                                    <ul>
                                        <li><a href="task_listing"><i class="fa fa-caret-right"></i> List Task</a></li>


                                    </ul>
                                </li>






                            </ul>
                            <!--/ NAVIGATION Content -->


                        </div>
                    </div>
                </div>

            </div>

        </div>


    </aside>
    <!--/ SIDEBAR Content -->





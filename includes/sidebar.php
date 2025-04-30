<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <?php
            if($admin_type == 0)
            {
            ?>

            <ul id="side-menu">
                <li>
                    <a href="Dashboard">
                        <i class="fas fa-chart-area"></i>
                        <span> ড্যাশ‌বোর্ড </span>
                    </a>
                </li>
                <li>
                    <a href="Add-Category">
                        <i class="fas fa-dice-two"></i>
                        <span> খাত </span>
                    </a>
                </li>
                <li>
                    <a href="Add-Sub-Category">
                        <i class="fas fa-clone"></i>
                        <span> উপ খাত </span>
                    </a>
                </li>
                <li>
                    <a href="Add-Expense">
                        <i class=" fas fa-chart-bar"></i>
                        <span> খরচ যুক্ত করুন </span>
                    </a>
                </li>
                <li>
                    <a href="View-Expense">
                        <i class=" fas fa-chart-bar"></i>
                        <span> খরচের তালিকা </span>
                    </a>
                </li>
                <li>
                    <a href="Add-Income">
                        <i class="fas fa-hand-holding-usd"></i>
                        <span> আয়/বরাদ্দ </span>
                    </a>
                </li>
                <li>
                    <a href="Withdraw">
                        <i class="fab fa-first-order"></i>
                        <span> বরাদ্দ উত্তোলন </span>
                    </a>
                </li>
                <li>
                    <a href="Give-Money">
                        <i class="fas fa-hands-helping"></i>
                        <span> বকেয়া পরিশোধ </span>
                    </a>
                </li>
                <li>
                    <a href="Report-Expense">
                        <i class="fas fa-flag"></i>
                        <span> খর‌চের রি‌পোর্ট </span>
                    </a>
                </li>
                <li>
                    <a href="Report-Income">
                        <i class="fas fa-flag-checkered"></i>
                        <span> আয়ের/উত্তোলনের রি‌পোর্ট </span>
                    </a>
                </li>
                <li>
                    <a href="Report">
                        <i class="fas fa-balance-scale-right"></i>
                        <span> আয়-খর‌চের রি‌পোর্ট </span>
                    </a>
                </li>

            </ul>
            <?php
            } elseif ($admin_type == 999){
            ?>
            <ul id="side-menu">
                <li>
                    <a href="Dashboard">
                        <i class="fas fa-chart-area"></i>
                        <span> ড্যাশ‌বোর্ড </span>
                    </a>
                </li>
                <li>
                    <a href="Report-Expense">
                        <i class="fas fa-flag"></i>
                        <span> খর‌চের রি‌পোর্ট </span>
                    </a>
                </li>
                <li>
                    <a href="Report-Income">
                        <i class="fas fa-flag-checkered"></i>
                        <span> আয়ের/উত্তোলনের রি‌পোর্ট </span>
                    </a>
                </li>
                <li>
                    <a href="Report">
                        <i class="fas fa-balance-scale-right"></i>
                        <span> আয়-খর‌চের রি‌পোর্ট </span>
                    </a>
                </li>

            </ul>
            <?php
            } else{
            ?>
            <ul id="side-menu">
                <li>
                    <a href="Add-Sub-Category">
                        <i class="fas fa-clone"></i>
                        <span> উপ খাত </span>
                    </a>
                </li>
                <li>
                    <a href="Add-Expense">
                        <i class=" fas fa-chart-bar"></i>
                        <span> খরচ যুক্ত করুন </span>
                    </a>
                </li>
                <li>
                    <a href="View-Expense">
                        <i class=" fas fa-chart-bar"></i>
                        <span> খরচের তালিকা </span>
                    </a>
                </li>
                <li>
                    <a href="Add-Income">
                        <i class="fas fa-hand-holding-usd"></i>
                        <span> আয় </span>
                    </a>
                </li>
                <li>
                    <a href="Withdraw">
                        <i class="fab fa-first-order"></i>
                        <span> বরাদ্দ উত্তোলন </span>
                    </a>
                </li>
                <li>
                    <a href="Give-Money">
                        <i class="fas fa-hands-helping"></i>
                        <span> বকেয়া পরিশোধ </span>
                    </a>
                </li>
                <li>
                    <a href="Report-Expense">
                        <i class="fas fa-flag"></i>
                        <span> খর‌চের রি‌পোর্ট </span>
                    </a>
                </li>
                <li>
                    <a href="Report-Income">
                        <i class="fas fa-flag-checkered"></i>
                        <span> আয়ের/উত্তোলনের রি‌পোর্ট </span>
                    </a>
                </li>
                <li>
                    <a href="Report">
                        <i class="fas fa-balance-scale-right"></i>
                        <span> আয়-খর‌চের রি‌পোর্ট </span>
                    </a>
                </li>

            </ul>
        <?php
            }
            ?>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
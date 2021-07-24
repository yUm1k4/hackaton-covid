<style>
    .img-topbar {
        object-fit: cover;
        height: 52px;
        width: 52px;
        border-radius: 50%;
    }
</style>

<div class="header">
    <div class="header-left pl-3">
        <div class="menu-icon dw dw-menu"></div>
        <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
        <div class="header-search">
            <form>
                <div class="form-group mb-0">
                    <?= "<span>" . format_indo(date('Y-m-d')) . " - <span id='jam'></span>"; ?>
                </div>
            </form>
        </div>
    </div>
    <div class="header-right">
        <div class="user-info-dropdown mr-3">
            <div class="dropdown">
                <a class="dropdown-toggle" href="javascript:;" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        <img src="<?= base_url('images/avatar.png/') ?>" width="90" class="img-fluid">
                    </span>
                    <span class="user-name"><?= xss(user()->username) ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item btn-logout" href="<?= base_url('logout') ?>"><i class="dw dw-logout"></i> Log Out</a>
                </div>
            </div>
        </div>
    </div>
</div>
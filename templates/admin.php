<div class="wrap">
    <h1>Jasa Demo Plugin</h1>
    <?php settings_errors(); ?>

    <ul id="navbar" class="navbar">
        <li data-tab="tab-1" class="navbar--tab navbar--tab__active">
            <p>Settings</p>
        </li>
        <li data-tab="tab-2" class="navbar--tab">
            <p>About</p>
        </li>
    </ul>

    <div class="tab-content">
        <div id="tab-1" class="tab tab--active">
            <form method="post" action="options.php">
		        <?php
                    settings_fields(option_group: 'pluginSettings');
                    do_settings_sections(page: 'jasa_demo');
                    submit_button();
		        ?>
            </form>
        </div>
        <div id="tab-2" class="tab">
            <h3>About tab.</h3>
        </div>
    </div>
</div>
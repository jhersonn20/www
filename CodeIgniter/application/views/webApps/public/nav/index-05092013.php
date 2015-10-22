<div id="mainNav"></div>
<div id="hidDiv" style="display: block;">
    <?php
        $menu = 0;
        if (ltrim($nav['0']['label']) != ""){
            foreach($nav as $navList):
                echo "<ul id='" . (($navList['submenu_code'] != 0) ? $navList['submenu_code'] : "jMenu") . "'>";
                echo (($navList['submenu_code'] < 2000 && $navList['submenu_code'] != 0) ? "<li class='arrow'></li>" : "");
                $pathSpl = explode(".",$navList['path']);
    ?>
        <li id="<?php echo $navList['menu_code']; ?>" <?php echo (($navList['just_label'] == 1) ? "style='width: 130px;'" : "") ?>>
        <?php
            //if ($navList['just_label'] == 1)
                echo "<span class='" . (($navList['menu_code'] < 2000) ? "fNiv" : "") . "' id='" . (($navList['path'] == "") ? "#" : $pathSpl[0]) . "'>" . ucfirst($navList['label']) . "</span>";
            //else
            //    echo "<a class='" . (($navList['menu_code'] < 2000) ? "fNiv" : "") . "' href='" . (($navList['path'] == "") ? "#" : $pathSpl[0]) . "'>" . ucfirst($navList['label']) . "</a>";
        ?>
        </li>
    <?php
                echo "</ul>";
            endforeach;
        }
    ?>
</div>
<script type="text/javascript" src="/assets/js/codeIgniter/default.js"></script>
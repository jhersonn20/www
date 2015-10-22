<div id="mainNav"></div>
<div id="hidDiv" style="display: block;">
    <?php
        $menu = 0;
        if (ltrim($nav['0']['mtitle']) != ""){
            foreach($nav as $navList):
                echo "<ul id='" . (($navList['subcode'] != 0) ? $navList['subcode'] : "jMenu") . "'>";
                echo (($navList['subcode'] < 2000 && $navList['subcode'] != 0) ? "<li class='arrow'></li>" : "");
                $pathSpl = explode(".","#");
				$filePath = explode(".", $navList["progname"]);
    ?>
        <li id="<?php echo $navList['menucode']; ?>" <?php echo (($navList['just_label'] == 1) ? "style='width: 130px;'" : "") ?>>
        <?php
            //if ($navList['just_label'] == 1)
            //    echo "<span class='" . (($navList['menucode'] < 2000) ? "fNiv" : "") . "' id='#'>" . ucfirst($navList['mtitle']) . "</span>";
            //else
                echo "<a class='" . (($navList['menucode'] < 2000) ? "fNiv" : "") . "' href='" . (($navList['progname'] != "") ? ("/codeIgniter/index.php/webapps/pub/page/".$system."/" . $filePath[0] . "/" . $navList['param']) : $pathSpl[0]) . "'>" . stripslashes(ucfirst($navList['mtitle'])) . "</a>";
        ?>
        </li>
    <?php
                echo "</ul>";
            endforeach;
        }
    ?>
</div>
<?php
	if (!isset($mainContent2))
		echo "<script type='text/javascript' src='/assets/js/codeIgniter/default.js'></script>";
?>
<!--<script type="text/javascript" src="/assets/js/codeIgniter/default.js"></script>-->
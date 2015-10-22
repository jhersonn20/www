<div class="boxContainer">
    <div class="viewPhase mainContent">
        <span class="title">Views</span>
            <input type="text" name="txtSrcView" id="txtSrcView" />
            <div class="dirPhase">
                <ul>
                <?php
                	if (isset($map) && $map){
                		foreach($map as $key => $value): ?>
                    <li><label for="viewChk<?php echo $key; ?>"> <input type="checkbox" name="viewChk[]" id="viewChk<?php echo $key; ?>" value="<?php echo $value; ?>" /> <?php echo $value; ?> </label></li>
                <?php
                		endforeach;
					}
                ?>
                </ul>
            </div>
        <div class="viewFooter mainContentF">
            <span class="view"> Select All </span>
            <input type="button" name="addButt" id="addButt" value="Add to Menu" />
        </div>
    </div>
    <div class="custViewPhase mainContent">
        <span class="title">Custom Views</span>
        <div class="custViewBody">
            <label for="txtLabel">Label: </label>
            <input type="text" name="txtLabel" id="txtLabel" />
            <label for="txtPath">Path: </label>
            <input type="text" name="txtPath" id="txtPath" />
        </div>
        <div class="custViewFooter mainContentF">
            <input type="button" name="custAddButt" id="custAddButt" value="Add to Menu" />
        </div>
    </div>
</div>
<div class="navPhase mainContent">        
    <span class="title">Navigation List</span>
    <div class="page">
        <div class="page_inner">
            <div class="col01"></div>
        </div>
    </div>
    <div class="navFooter mainContentF">        
        <input type="button" name="saveButt" id="saveButt" value="Save" />
    </div>
</div>
<input type="hidden" name="jsonData" id="jsonData" />
<div id="hidDiv">
    <?php
        $menu = 0;
        if (ltrim($nav['0']['description']) != ""){
            foreach($nav as $navList):
                echo "<ul id='" . (($navList['subcode'] != 0) ? $navList['subcode'] : "sitemap") . "'>";
    ?>
        <li id="<?php echo $navList['menucode']; ?>">
            <dl class="sm2_s_published">
                <dt>
                    <span class="sm2_title"><?php echo ucfirst($navList['description']); ?></span>
                </dt>
                <dd class="sm2_actions">
                    <span class="sm2_delete" title="Delete">Delete</span>
                    <span class="sm2_edit" title="Edit">Edit</span>
                </dd>
                <dd class="sm2_status">
                    <span class="sm2_pub" title="Published" style="display: <?php echo (($navList['publish'] != 0) ? "block" : "none"); ?>">Published</span>
                    <span class="sm2_workFlow" title="Draft Exists" style="display: <?php echo (($navList['publish'] != 0) ? "none" : "block"); ?>">Draft Exists</span>
                </dd>
                <div id="menuDtls">
                    <label for="txtLabel">Label: </label><input type="text" name="txtLabel" id="txtLabel" value="<?php echo ucfirst($navList['description']); ?>" />
                    <input type="hidden" name="txtPath" id="txtPath" value="<?php echo $navList['app_name']; ?>" />
                </div>
            </dl>
        </li>
    <?php
                echo "</ul>";
            endforeach;
        }
    ?>
</div>
<script type="text/javascript" src="/assets/js/ul.js"></script>
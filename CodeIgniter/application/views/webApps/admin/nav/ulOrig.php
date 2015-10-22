<div id="mainContent">
    <div style="width: 810px;height: 320px;margin: 0 auto;">
        <div class="notif" style="background: orange;color: #ffffff;">
            <?php echo (isset($notification)) ? $notification : ""; ?>
        </div>
        <?php
            $attributes = array("name" => "navForm");
            echo form_open('qms_struc/admin/navManage', $attributes);
        ?>
        <div class="viewPhase" style="width: 300px;height: 300px;border: 1px dashed;float: left;display: table;">
            <div style="background: #228af4;text-align: center;font-size: 20px;display: table-row;vertical-align: top;">
                Views
            </div>
            <div class="dirPhase" style="height: 249px;overflow: hidden;">
                <ul>
                <?php foreach($map as $key => $value): ?>
                    <li><input type="checkbox" name="viewChk[]" id="viewChk<?php echo $key; ?>" value="<?php echo $value; ?>" /><label for="viewChk<?php echo $key; ?>"> <?php echo $value; ?> </label></li>
                <?php endforeach ?>
                </ul>
            </div>
            <div style="background: #228af4;padding: 5px 0;display: table-row;vertical-align: bottom;">
                <input type="checkbox" name="viewChkAll" id="viewChkAll" /><label for="viewChkAll"> Toggle Select </label>
                <button type="button" name="addButt" id="addButt" style="float: right;"> Add </button>
            </div>
        </div>
        <div class="navPhase" style="width: 500px;height: 600px;border: 1px dashed;float: right;display: table;">        
            <div style="background: #228af4;text-align: center;font-size: 20px;display: table-row;vertical-align: top;">
                Navigation List
            </div>
            <div class="tempNavPhase" style="width: 500px;height: 589px;overflow: auto;">
                <div class="page">
                    <div class="page_inner">
                        <div class="col01"></div>
                    </div>
                </div>
            </div>
            <div style="background: #228af4;padding: 5px 0;display: table-row;vertical-align: bottom;">        
                <button type="button" name="saveButt" id="saveButt" style="float: right;"> Save </button>
            </div>
        </div>
        <input type="hidden" name="jsonData" id="jsonData" />
        </form>
    </div>
    <div id="hidDiv" style="display: block;">
        <?php
            $menu = 0;
            if (ltrim($nav['0']['label']) != ""){
                foreach($nav as $navList):
                    echo "<ul id='" . (($navList['submenu_code'] != 0) ? $navList['submenu_code'] : "sitemap") . "'>";
        ?>
            <li id="<?php echo $navList['menu_code']; ?>">
                <dl class="sm2_s_published"><a href="#"class="sm2_expander">&nbsp;</a>
                    <dt>
                        <!--<a class="sm2_title" href="#"><?php //echo $navList['path']; ?></a>-->
                        <span class="sm2_title"><?php echo ucfirst($navList['label']); ?></span>
                    </dt>
                    <dd class="sm2_actions">
                        <strong>Actions:</strong>
                        <!--<span class="sm2_move" title="Move">Move</span>-->
                        <span class="sm2_delete" title="Delete">Delete</span>
                        <span class="sm2_edit" title="Edit">Edit</span>
                    </dd> <!--<a href="#" class="sm2_addChild" title="Add Child">Add Child</a>-->
                    <dd class="sm2_status">
                        <strong>Status:</strong>
                        <span class="sm2_pub" title="Published" style="display: <?php echo (($navList['publish'] != 0) ? "block" : "none"); ?>">Published</span>
                        <span class="sm2_workFlow" title="Draft Exists" style="display: <?php echo (($navList['publish'] != 0) ? "none" : "block"); ?>">Draft Exists</span>
                    </dd>
                </dl>
                <div id="menuDtls">
                    <label for="txtLabel">Label:</label><input type="text" name="txtLabel" id="txtLabel" value="<?php echo ucfirst($navList['label']); ?>" />
                    <input type="hidden" name="txtPath" id="txtPath" value="<?php echo $navList['path']; ?>" />
                </div>
            </li>
        <?php
                    echo "</ul>";
                endforeach;
            }
        ?>
    </div>
</div>
<script type="text/javascript" src="/assets/js/ul.js"></script>
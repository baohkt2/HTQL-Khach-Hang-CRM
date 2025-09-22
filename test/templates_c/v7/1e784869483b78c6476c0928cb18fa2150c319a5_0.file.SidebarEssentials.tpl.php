<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:46:03
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Documents\partials\SidebarEssentials.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c915bb8b61f0_29709359',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1e784869483b78c6476c0928cb18fa2150c319a5' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Documents\\partials\\SidebarEssentials.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c915bb8b61f0_29709359 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="sidebar-menu sidebar-menu-full">
    <div class="module-filters" id="module-filters">
        <div class="sidebar-container lists-menu-container">
            <div class="sidebar-header clearfix">
                <h5 class="pull-left">Lists </h5>
                <button id="createFilter" data-url="<?php echo CustomView_Record_Model::getCreateViewUrl($_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="btn btn-default pull-right sidebar-btn">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </button> 
            </div>
            <hr>
            <div>
                <input class="search-list" type="text" placeholder="Search for List">
            </div>
            <div class="menu-scroller scrollContainer" style="position:relative; top:0; left:0;">
                        <div class="list-menu-content">
                                <?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEWS']->value && php7_count($_smarty_tpl->tpl_vars['CUSTOM_VIEWS']->value) > 0) {?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CUSTOM_VIEWS']->value, 'GROUP_CUSTOM_VIEWS', false, 'GROUP_LABEL');
$_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['GROUP_LABEL']->value => $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->value) {
$_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->do_else = false;
?>
                                    <?php if ($_smarty_tpl->tpl_vars['GROUP_LABEL']->value != 'Mine' && $_smarty_tpl->tpl_vars['GROUP_LABEL']->value != 'Shared') {?>
                                        <?php continue 1;?>
                                     <?php }?>
                                    <div class="list-group">   
                                        <h6 class="lists-header <?php if (php7_count($_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->value) <= 0) {?> hide <?php }?>" >
                                            <?php if ($_smarty_tpl->tpl_vars['GROUP_LABEL']->value == 'Mine') {?>
                                                <?php echo vtranslate('LBL_MY_LIST',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                            <?php } else { ?>
                                                <?php echo vtranslate('LBL_SHARED_LIST',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                            <?php }?>
                                        </h6>
                                        <input type="hidden" name="allCvId" value="<?php echo CustomView_Record_Model::getAllFilterByModule($_smarty_tpl->tpl_vars['MODULE']->value)->get('cvid');?>
" />
                                        <ul class="lists-menu">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->value, 'CUSTOM_VIEW', false, NULL, 'customView', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['CUSTOM_VIEW']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value) {
$_smarty_tpl->tpl_vars['CUSTOM_VIEW']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_customView']->value['iteration']++;
?>
                                            <li style="font-size:12px;" class='listViewFilter <?php if ($_smarty_tpl->tpl_vars['VIEWID']->value == $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getId() && ($_smarty_tpl->tpl_vars['CURRENT_TAG']->value == '') && !$_smarty_tpl->tpl_vars['FOLDER_VALUE']->value) {?> active<?php }?> <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_customView']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_customView']->value['iteration'] : null) > 5) {?> filterHidden hide<?php }?> '>
                                                <?php ob_start();
echo vtranslate($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('viewname'),$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable5 = ob_get_clean();
$_smarty_tpl->_assignInScope('VIEWNAME', $_prefixVariable5);?> 
                                                <a class="filterName" href="javascript:;" data-filter-id="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getId();?>
"><?php ob_start();
echo strlen((string) $_smarty_tpl->tpl_vars['VIEWNAME']->value);
$_prefixVariable6 = ob_get_clean();
if ($_prefixVariable6 > 40) {?> <?php echo htmlspecialchars((string)call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['VIEWNAME']->value,0,40 )), ENT_QUOTES, 'UTF-8', true);?>
..<?php } else {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['VIEWNAME']->value, ENT_QUOTES, 'UTF-8', true);
}?></a> 
                                                    <div class=" pull-right">
                                                        <span class="js-popover-container">
                                                    <span class="fa fa-angle-down" rel="popover" data-toggle="popover" aria-expanded="true" 
                                                        <?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isMine() && $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('viewname') != 'All') {?>
                                                            data-deletable="<?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isDeletable()) {?>true<?php } else { ?>false<?php }?>" data-editable="<?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isEditable()) {?>true<?php } else { ?>false<?php }?>" 
                                                            <?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isEditable()) {?>  data-editurl="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getEditUrl();
}?>" <?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isDeletable()) {?> data-deleteurl="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getDeleteUrl();?>
"<?php }?>
                                                            <?php }?>
                                                          toggleClass="fa <?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isDefault()) {?>fa-check-square-o<?php } else { ?>fa-square-o<?php }?>" data-filter-id="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getId();?>
" 
                                                          data-is-default="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isDefault();?>
" data-defaulttoggle="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getToggleDefaultUrl();?>
" data-default="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getDuplicateUrl();?>
" data-isMine="<?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isMine()) {?>true<?php } else { ?>false<?php }?>">
                                                    </span>
                                                        </span>                                               
                                                    </div>
                                                        </li>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </ul>
                                            

                                        <div class='clearfix'> 
                                            <a class="toggleFilterSize" data-more-text="Show more" data-less-text="Show less"> 
                                                <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_customView']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_customView']->value['iteration'] : null) > 5) {?>
                                                    <?php echo vtranslate('LBL_SHOW_MORE','Vtiger');?>

                                                <?php }?>
                                            </a>
                                        </div>
                                     </div>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    <div id="filterActionPopoverHtml">
                                        <ul class="listmenu hide" role="menu">
                                            <li role="presentation" class="editFilter">
                                                <a role="menuitem"><i class="fa fa-pencil-square-o"></i>&nbsp;<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                                            </li>
                                            <li role="presentation" class="deleteFilter ">
                                                <a role="menuitem"><i class="fa fa-trash"></i>&nbsp;<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                                            </li>
                                            <li role="presentation" class="duplicateFilter">
                                                <a role="menuitem" ><i class="fa fa-files-o"></i>&nbsp;<?php echo vtranslate('LBL_DUPLICATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                                                </li>
                                            <li role="presentation" class="toggleDefault" >
                                                    <a role="menuitem" >
                                                    <i data-check-icon="fa-check-square-o" data-uncheck-icon="fa-square-o"></i>&nbsp;<?php echo vtranslate('LBL_DEFAULT',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                                    </a>
                                                </li>
                                            </ul>
                                    </div>
                                <?php }?>
                                <div class="list-group hide noLists">
                                    <h6 class="lists-header"><center> <?php echo vtranslate('LBL_NO');?>
 <?php echo vtranslate('Lists');?>
 <?php echo vtranslate('LBL_FOUND');?>
 ... </center></h6>
                                </div>
                        </div>
            </div><div class="sidebar-header clearfix">
                        <h5 class="pull-left"><?php echo vtranslate('LBL_FOLDERS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h5>
                        <button id="createFolder" class="btn btn-default pull-right sidebar-btn">
                            <span class="fa fa-plus" aria-hidden="true"></span>
                        </button>
                    </div>
                    <hr>
                    <div>
                        <input class="search-folders" type="text" placeholder="Search for Folders">
                    </div>
           <div class="menu-scroller scrollContainer" style="position:relative; top:0; left:0;">                     
            <div class="list-menu-content">
                <div class="list-group">
                    <ul id="folders-list"  class="lists-menu">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FOLDERS']->value, 'FOLDER', false, NULL, 'folderView', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['FOLDER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FOLDER']->value) {
$_smarty_tpl->tpl_vars['FOLDER']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_folderView']->value['iteration']++;
?>
                         <?php ob_start();
echo vtranslate($_smarty_tpl->tpl_vars['FOLDER']->value->get('foldername'),$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable7 = ob_get_clean();
$_smarty_tpl->_assignInScope('FOLDERNAME', $_prefixVariable7);?> 
                        <li style="font-size:12px;" class='documentFolder <?php if ($_smarty_tpl->tpl_vars['FOLDER_VALUE']->value == $_smarty_tpl->tpl_vars['FOLDER']->value->getName()) {?> active<?php }?> <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_folderView']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_folderView']->value['iteration'] : null) > 5) {?> filterHidden hide<?php }?>'>
                            <a class="filterName" href="javascript:void(0);" data-filter-id="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->get('folderid');?>
" data-folder-name="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->get('foldername');?>
" title="<?php echo $_smarty_tpl->tpl_vars['FOLDERNAME']->value;?>
">
                                <i class="fa <?php if ($_smarty_tpl->tpl_vars['FOLDER_VALUE']->value == $_smarty_tpl->tpl_vars['FOLDER']->value->getName()) {?>fa-folder-open<?php } else { ?>fa-folder<?php }?>"></i> 
                                <span class="foldername"><?php ob_start();
echo strlen((string) $_smarty_tpl->tpl_vars['FOLDERNAME']->value);
$_prefixVariable8 = ob_get_clean();
if ($_prefixVariable8 > 40) {?> <?php echo htmlspecialchars((string)call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['FOLDERNAME']->value,0,40 )), ENT_QUOTES, 'UTF-8', true);?>
..<?php } else {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['FOLDERNAME']->value, ENT_QUOTES, 'UTF-8', true);
}?></span>
                            </a>
                            <?php if ($_smarty_tpl->tpl_vars['FOLDER']->value->getName() != 'Default' && $_smarty_tpl->tpl_vars['FOLDER']->value->getName() != 'Google Drive' && $_smarty_tpl->tpl_vars['FOLDER']->value->getName() != 'Dropbox') {?>
                                <div class="dropdown pull-right">
                                    <span class="fa fa-caret-down dropdown-toggle" data-toggle="dropdown" aria-expanded="true"></span>
                                    <ul class="dropdown-menu dropdown-menu-right vtDropDown" role="menu">
                                        <li class="editFolder " data-folder-id="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->get('folderid');?>
">
                                            <a role="menuitem" ><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>
                                        </li>
                                        <li class="deleteFolder " data-deletable="<?php echo !$_smarty_tpl->tpl_vars['FOLDER']->value->hasDocuments();?>
" data-folder-id="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->get('folderid');?>
">
                                            <a role="menuitem" ><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            <?php }?>
                        </li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <li class="noFolderText" style="display: none;">
                        <h6 class="lists-header"><center> 
                            <?php echo vtranslate('LBL_NO');?>
 <?php echo vtranslate('LBL_FOLDERS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND');?>
 ... 
                        </center></h6>    
                    </li>
                    </ul>
		<div class='clearfix'> 
                	<a class="toggleFilterSize" data-more-text="Show more" data-less-text="Show less"> 
	                       	<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_folderView']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_folderView']->value['iteration'] : null) > 5) {?>
        	                	<?php echo vtranslate('LBL_SHOW_MORE','Vtiger');?>

				<?php }?>
			</a>
                </div>
                 </div>
            </div></div>
            
        </div>
    </div>
    <div class="module-filters">
        <div class="sidebar-container lists-menu-container">
            <h4 class="lists-header">
                <?php echo vtranslate('LBL_TAGS',$_smarty_tpl->tpl_vars['MODULE']->value);?>

            </h4>
            <hr>
            <div class="menu-scroller scrollContainer" style="position:relative; top:0; left:0;">
                        <div class="list-menu-content">
                            <div id="listViewTagContainer" class="multiLevelTagList" 
                            <?php if ((isset($_smarty_tpl->tpl_vars['ALL_CUSTOMVIEW_MODEL']->value)) && $_smarty_tpl->tpl_vars['ALL_CUSTOMVIEW_MODEL']->value) {?> data-view-id="<?php echo $_smarty_tpl->tpl_vars['ALL_CUSTOMVIEW_MODEL']->value->getId();?>
" <?php }?>
                            data-list-tag-count="<?php echo Vtiger_Tag_Model::NUM_OF_TAGS_LIST;?>
">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['TAGS']->value, 'TAG_MODEL', false, NULL, 'tagCounter', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['TAG_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TAG_MODEL']->value) {
$_smarty_tpl->tpl_vars['TAG_MODEL']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_tagCounter']->value['iteration']++;
?>
                                    <?php $_smarty_tpl->_assignInScope('TAG_LABEL', $_smarty_tpl->tpl_vars['TAG_MODEL']->value->getName());?>
                                    <?php $_smarty_tpl->_assignInScope('TAG_ID', $_smarty_tpl->tpl_vars['TAG_MODEL']->value->getId());?>
                                    <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_tagCounter']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_tagCounter']->value['iteration'] : null) > Vtiger_Tag_Model::NUM_OF_TAGS_LIST) {?>
                                        <?php break 1;?>
                                    <?php }?>
                                    <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Tag.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('NO_DELETE'=>true,'ACTIVE'=>$_smarty_tpl->tpl_vars['CURRENT_TAG']->value == $_smarty_tpl->tpl_vars['TAG_ID']->value), 0, true);
?>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                <div> 
                                    <a class="moreTags <?php if ((php7_count($_smarty_tpl->tpl_vars['TAGS']->value)-Vtiger_Tag_Model::NUM_OF_TAGS_LIST) <= 0) {?> hide <?php }?>">
                                        <span class="moreTagCount"><?php echo php7_count($_smarty_tpl->tpl_vars['TAGS']->value)-Vtiger_Tag_Model::NUM_OF_TAGS_LIST;?>
</span>
                                        &nbsp;<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strtolower' ][ 0 ], array( vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE']->value) ));?>

                                    </a>
                                    <div class="moreListTags hide">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['TAGS']->value, 'TAG_MODEL', false, NULL, 'tagCounter', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['TAG_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TAG_MODEL']->value) {
$_smarty_tpl->tpl_vars['TAG_MODEL']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_tagCounter']->value['iteration']++;
?>
                                    <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_tagCounter']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_tagCounter']->value['iteration'] : null) <= Vtiger_Tag_Model::NUM_OF_TAGS_LIST) {?>
                                        <?php continue 1;?>
                                    <?php }?>
                                    <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Tag.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('NO_DELETE'=>true,'ACTIVE'=>$_smarty_tpl->tpl_vars['CURRENT_TAG']->value == $_smarty_tpl->tpl_vars['TAG_ID']->value), 0, true);
?>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                     </div>
                                </div>
                            </div>
                            <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "AddTagUI.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('RECORD_NAME'=>'','TAGS_LIST'=>array()), 0, true);
?>
                        </div>
                        <div id="dummyTagElement" class="hide">
                            <?php $_smarty_tpl->_assignInScope('TAG_MODEL', Vtiger_Tag_Model::getCleanInstance());?>
                            <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Tag.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('NO_DELETE'=>true), 0, true);
?>
                        </div>
                        <div class="editTagContainer hide">
                            <input type="hidden" name="id" value="" />
                            <div class="editTagContents">
                                <div>
                                    <input type="text" name="tagName" class="createtag" value="" style="width:100%" />
                                </div>
                                <div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="hidden" name="visibility" value="<?php echo Vtiger_Tag_Model::PRIVATE_TYPE;?>
"/>
                                            <input type="checkbox" name="visibility" value="<?php echo Vtiger_Tag_Model::PUBLIC_TYPE;?>
" />
                                            &nbsp; <?php echo vtranslate('LBL_MAKE_PUBLIC',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-mini btn-success saveTag" style="width:50%;float:left">
                                    <center> <i class="fa fa-check"></i> </center>
                                </button>
                                <button class="btn btn-mini btn-danger cancelSaveTag" style="width:50%">
                                    <center> <i class="fa fa-close"></i> </center>
                                </button>
                            </div>
                        </div>
            </div>
        </div>
     </div>
</div>


<?php }
}

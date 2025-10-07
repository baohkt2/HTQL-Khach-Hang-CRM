{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*************************************************************************************}

{strip}
	<div class='related-tabs row'>
		<nav class="navbar margin0" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle btn-group-justified collapsed border0" data-toggle="collapse" data-target="#nav-tabs" aria-expanded="false">
					<i class="fa fa-ellipsis-h"></i>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="nav-tabs">
				<ul class="nav nav-tabs">
					{foreach item=RELATED_LINK from=$DETAILVIEW_LINKS['DETAILVIEWTAB']}
						{assign var=RELATEDLINK_URL value=$RELATED_LINK->getUrl()}
						{assign var=RELATEDLINK_LABEL value=$RELATED_LINK->getLabel()}
						{assign var=RELATED_TAB_LABEL value={vtranslate('SINGLE_'|cat:$MODULE_NAME, $MODULE_NAME)}|cat:" "|cat:$RELATEDLINK_LABEL}
						<li class="tab-item {if $RELATED_TAB_LABEL==$SELECTED_TAB_LABEL}active{/if}" data-url="{$RELATEDLINK_URL}&tab_label={$RELATED_TAB_LABEL}&app={$SELECTED_MENU_CATEGORY}" data-label-key="{$RELATEDLINK_LABEL}" data-link-key="{$RELATED_LINK->get('linkKey')}" >
							<a href="{$RELATEDLINK_URL}&tab_label={$RELATEDLINK_LABEL}&app={$SELECTED_MENU_CATEGORY}" class="textOverflowEllipsis">
								<span class="tab-label"><strong>{vtranslate($RELATEDLINK_LABEL,{$MODULE_NAME})}</strong></span>
							</a>
						</li>
					{/foreach}

                                        {if isset($DETAILVIEW_LINKS['DETAILVIEWRELATED'])}
					        {assign var=RELATEDTABS value=$DETAILVIEW_LINKS['DETAILVIEWRELATED']}
                                        {/if}
                                        {if !empty($RELATEDTABS)}
                                            {assign var=COUNT value=$RELATEDTABS|@count}

                                            {assign var=LIMIT value = 10}
                                            {if $COUNT gt 10}
                                                    {assign var=COUNT1 value = $LIMIT}
                                            {else}
                                                    {assign var=COUNT1 value=$COUNT}
                                            {/if}

                                            {for $i = 0 to $COUNT1-1}
                                                    {assign var=RELATED_LINK value=$RELATEDTABS[$i]}
                                                    {assign var=RELATEDMODULENAME value=$RELATED_LINK->getRelatedModuleName()}
                                                    {assign var=RELATEDFIELDNAME value=$RELATED_LINK->get('linkFieldName')}
                                                    {assign var="DETAILVIEWRELATEDLINKLBL" value= vtranslate($RELATED_LINK->getLabel(),$RELATEDMODULENAME)}
                                                    <li class="tab-item {if (trim($RELATED_LINK->getLabel())== trim($SELECTED_TAB_LABEL)) && ($RELATED_LINK->getId() == $SELECTED_RELATION_ID)}active{/if}" data-url="{$RELATED_LINK->getUrl()}&tab_label={$RELATED_LINK->getLabel()}&app={$SELECTED_MENU_CATEGORY}" data-label-key="{$RELATED_LINK->getLabel()}"
                                                            data-module="{$RELATEDMODULENAME}" data-relation-id="{$RELATED_LINK->getId()}" {if $RELATEDMODULENAME eq "ModComments"} title {else} title="{$DETAILVIEWRELATEDLINKLBL}"{/if} {if $RELATEDFIELDNAME}data-relatedfield ="{$RELATEDFIELDNAME}"{/if}>
                                                            <a href="index.php?{$RELATED_LINK->getUrl()}&tab_label={$RELATED_LINK->getLabel()}&app={$SELECTED_MENU_CATEGORY}" class="textOverflowEllipsis" displaylabel="{$DETAILVIEWRELATEDLINKLBL}" recordsCount="" >
                                                                    {if $RELATEDMODULENAME eq "ModComments"}
                                                                            <span class="tab-icon"><i class="fa fa-comment" style="font-size: 24px"></i></span>
                                                                    {else}
                                                                            <span class="tab-icon">
                                                                                    {assign var=RELATED_MODULE_MODEL value=Vtiger_Module_Model::getInstance($RELATEDMODULENAME)}
                                                                                    {$RELATED_MODULE_MODEL->getModuleIcon()}
                                                                            </span>
                                                                    {/if}
                                                                    &nbsp;<span class="numberCircle hide">0</span>
                                                            </a>
                                                    </li>
                                                    {if ($RELATED_LINK->getId() == {$REQ->get('relationId')})}
                                                            {assign var=MORE_TAB_ACTIVE value='true'}
                                                    {/if}
                                            {/for}
                                            {if $MORE_TAB_ACTIVE neq 'true'}
                                                    {for $i = 0 to $COUNT-1}
                                                            {assign var=RELATED_LINK value=$RELATEDTABS[$i]}
                                                            {if ($RELATED_LINK->getId() == {$REQ->get('relationId')})}
                                                                    {assign var=RELATEDMODULENAME value=$RELATED_LINK->getRelatedModuleName()}
                                                                    {assign var=RELATEDFIELDNAME value=$RELATED_LINK->get('linkFieldName')}
                                                                    {assign var="DETAILVIEWRELATEDLINKLBL" value= vtranslate($RELATED_LINK->getLabel(),$RELATEDMODULENAME)}
                                                                    <li class="more-tab moreTabElement active"  data-url="{$RELATED_LINK->getUrl()}&tab_label={$RELATED_LINK->getLabel()}&app={$SELECTED_MENU_CATEGORY}" data-label-key="{$RELATED_LINK->getLabel()}"
                                                                            data-module="{$RELATEDMODULENAME}" data-relation-id="{$RELATED_LINK->getId()}" {if $RELATEDMODULENAME eq "ModComments"} title {else} title="{$DETAILVIEWRELATEDLINKLBL}"{/if} {if $RELATEDFIELDNAME}data-relatedfield ="{$RELATEDFIELDNAME}"{/if}>
                                                                            <a href="index.php?{$RELATED_LINK->getUrl()}&tab_label={$RELATED_LINK->getLabel()}&app={$SELECTED_MENU_CATEGORY}" class="textOverflowEllipsis" displaylabel="{$DETAILVIEWRELATEDLINKLBL}" recordsCount="" >
                                                                                    {if $RELATEDMODULENAME eq "ModComments"}
                                                                                            <span class="tab-icon"><i class="fa fa-comment" style="font-size: 24px"></i></span>
                                                                                    {else}
                                                                                            <span class="tab-icon">
                                                                                                    {assign var=RELATED_MODULE_MODEL value=Vtiger_Module_Model::getInstance($RELATEDMODULENAME)}
                                                                                                    {$RELATED_MODULE_MODEL->getModuleIcon()}
                                                                                            </span>
                                                                                    {/if}
                                                                                    &nbsp;<span class="numberCircle hide">0</span>
                                                                            </a>
                                                                    </li>
                                                                    {break}
                                                            {/if}
                                                    {/for}
                                            {/if}
                                            {if $COUNT gt $LIMIT}
                                                    <li class="dropdown related-tab-more-element">
                                                            <a href="javascript:void(0)" data-toggle="dropdown" class="dropdown-toggle">
                                                                    <span class="tab-label">
                                                                            <strong>{vtranslate("LBL_MORE",$MODULE_NAME)}</strong> &nbsp; <b class="fa fa-caret-down"></b>
                                                                    </span>
                                                            </a>
                                                            <ul class="dropdown-menu pull-right" id="relatedmenuList">
                                                                    {for $j = $COUNT1 to $COUNT-1}
                                                                            {assign var=RELATED_LINK value=$RELATEDTABS[$j]}
                                                                            {assign var=RELATEDMODULENAME value=$RELATED_LINK->getRelatedModuleName()}
                                                                            {assign var=RELATEDFIELDNAME value=$RELATED_LINK->get('linkFieldName')}
                                                                            {assign var="DETAILVIEWRELATEDLINKLBL" value= vtranslate($RELATED_LINK->getLabel(),$RELATEDMODULENAME)}
                                                                            <li class="more-tab {if (trim($RELATED_LINK->getLabel())== trim($SELECTED_TAB_LABEL)) && ($RELATED_LINK->getId() == $SELECTED_RELATION_ID)}active{/if}" data-url="{$RELATED_LINK->getUrl()}&tab_label={$RELATED_LINK->getLabel()}&app={$SELECTED_MENU_CATEGORY}" data-label-key="{$RELATED_LINK->getLabel()}"
                                                                                    data-module="{$RELATEDMODULENAME}" title="" data-relation-id="{$RELATED_LINK->getId()}" {if $RELATEDFIELDNAME}data-relatedfield ="{$RELATEDFIELDNAME}"{/if}>
                                                                                    <a href="index.php?{$RELATED_LINK->getUrl()}&tab_label={$RELATED_LINK->getLabel()}&app={$SELECTED_MENU_CATEGORY}" displaylabel="{$DETAILVIEWRELATEDLINKLBL}" recordsCount="">
                                                                                            {if $RELATEDMODULENAME eq "ModComments"}
                                                                                                <span class="tab-icon textOverflowEllipsis">
                                                                                                    <i class="fa fa-comment"></i> &nbsp;<span class="content">{$DETAILVIEWRELATEDLINKLBL}</span>
                                                                                                </span>
                                                                                            {else}
                                                                                                    {assign var=RELATED_MODULE_MODEL value=Vtiger_Module_Model::getInstance($RELATEDMODULENAME)}
                                                                                                    <span class="tab-icon textOverflowEllipsis">
                                                                                                            {$RELATED_MODULE_MODEL->getModuleIcon()}
                                                                                                            <span class="content"> &nbsp;{$DETAILVIEWRELATEDLINKLBL}</span>
                                                                                                    </span>
                                                                                            {/if}
                                                                                            &nbsp;<span class="numberCircle hide">0</span>
                                                                                    </a>
                                                                            </li>
                                                                    {/for}
                                                            </ul>
                                                    </li>
                                            {/if}
                                        {/if}
				</ul>
				<div class="navbar-right" style="padding: 8px 10px;">
					<button type="button" id="vtCallButton" class="btn btn-primary">
						<i class="fa fa-phone"></i>&nbsp;Call
					</button>
					<select id="vtCallStatusSelect" class="select2" style="min-width: 180px; margin-left: 8px;">
						<option value="chua_goi">Chưa gọi</option>
						<option value="da_goi">Đã gọi</option>
						<option value="chan">Chặn</option>
						<option value="khong_nghe_may">Không nghe máy</option>
					</select>
				</div>
			</div>
		</nav>
	</div>
	{strip}

<script>
(function() {
	// Mock phone number; replace with real field if available
	var mockPhoneNumber = '+84123456789';
	var callButton = document.getElementById('vtCallButton');
	var statusSelect = document.getElementById('vtCallStatusSelect');

	if (!callButton || !statusSelect) return;

	// Restore saved status from localStorage
	try {
		var savedStatus = localStorage.getItem('vt_call_status') || 'chua_goi';
		statusSelect.value = savedStatus;
	} catch (e) {}

	// Save status on change
	statusSelect.addEventListener('change', function() {
		try { localStorage.setItem('vt_call_status', statusSelect.value); } catch (e) {}
	});

	// Trigger call using tel: scheme
	callButton.addEventListener('click', function() {
		if (!mockPhoneNumber) { return; }
		window.location.href = 'tel:' + mockPhoneNumber;
	});
})();
</script>
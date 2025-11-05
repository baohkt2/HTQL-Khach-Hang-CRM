{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}
{strip}
	<div class="main-container clearfix">
		<div class="ExtensionscontentsDiv contentsDiv">
			<div class="col-sm-12 col-xs-12" id="importModules">
				<div class="contents tabbable row">
					<div class="col-sm-12 col-xs-12" id="extensionContainer">
						{include file='ExtensionModules.tpl'|@vtemplate_path:$QUALIFIED_MODULE}
					</div>
				</div>
			</div>
		</div>
	</div>
{/strip}
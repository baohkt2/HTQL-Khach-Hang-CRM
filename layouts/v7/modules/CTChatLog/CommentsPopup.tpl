{*+**********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
************************************************************************************}
<div id="sendFacebookMsgContainer" class='modal-xs modal-dialog'>
    <div class = "modal-content">
        <div class="modal-header" style="height: 50px;">
            <button type="button" class="close " data-dismiss="modal" aria-hidden="true" style="float: right;">&times;</button>
           <h4>{vtranslate('Add Comments',$MODULE)}</h4>&nbsp;
        </div>
		<div class="commentblock">
			<label style="margin: 60px 0px 0px 46px;"><b>{vtranslate('LBL_SELECT_DATE',$MODULE)}</b></label>
			<select class="select2" id="datefilter" style="min-width: 220px;margin: 0px 0px 0px 24px;" data-placeholder="{vtranslate('LBL_SELECT_DATE', $MODULE)}">
				<option value="">{vtranslate('LBL_SELECTANOPTION',$MODULE)}</option>
				<option value="today">{vtranslate('LBL_Today',$MODULE)}</option>
				<option value="yesterday">{vtranslate('LBL_Yesterday',$MODULE)}</option>
				<option value="this_week">{vtranslate('LBL_ThisWeek',$MODULE)}</option>
				<option value="last_week">{vtranslate('LBL_LastWeek',$MODULE)}</option>
				<option value="this_month">{vtranslate('LBL_ThisMonth',$MODULE)}</option>
				<option value="last_month">{vtranslate('LBL_LastMonth',$MODULE)}</option>
				<option value="custom">{vtranslate('LBL_Custom',$MODULE)}</option>
			</select>
		</div><br><br>
		<div style="margin-left: 50px;">
			<input type="radio" id="commententry" name="commententry" value="single" style="margin-left: 30px;">
			<span style="margin-left: 40px;"><b>{vtranslate('LBL_SINGLEENTRY',$MODULE)}</b></span>&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
			<input type="radio" id="commententry" name="commententry" value="multiple" style="margin-left: 30px;">
			<span style="margin-left: 40px;"><b>{vtranslate('LBL_MULTIPLEENTRIES',$MODULE)}</b></span>
		</div>
		<div class="customdateblock hide">
			<label style="margin: 30px 0px 0px 46px;"><b>{vtranslate('LBL_SelectCustomeDate',$MODULE)}</b></label>
			<div class="input-group inputElement" style="margin-bottom: 3px;width: 55%;margin: -30px 0px 0px 135px;">
				<input id="customdate" type="text" class="dateField form-control " data-fieldname="customdate" data-fieldtype="date" name="customdate" data-date-format="mm-dd-yyyy" value="" data-calendar-type="range" data-rule-date="true">
				<span class="input-group-addon">
					<i class="fa fa-calendar "></i>
				</span>
			</div>
		</div><br><br>
		<div class="modal-footer">
			<center>
				<button id="savecommentsfb" class="btn btn-success">{vtranslate('LBL_SAVE',$MODULE)}</button>&nbsp;&nbsp;
				<a type="reset" data-dismiss="modal" class="cancelLink cursorPointer">{vtranslate('LBL_CANCEL',$MODULE)}</a>
			</center>
        </div>
    </div>
</div>

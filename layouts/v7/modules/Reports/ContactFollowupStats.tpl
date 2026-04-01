{strip}
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3 style="margin: 10px 0;">Báo cáo thống kê theo dõi liên hệ</h3>

			<form class="form-inline" method="get" action="index.php" style="margin-bottom: 12px;">
				<input type="hidden" name="module" value="Reports" />
				<input type="hidden" name="view" value="ContactFollowupStats" />

				<label style="margin-right:6px;">Từ ngày</label>
				<input type="date" name="from" value="{$FILTER_FROM}" required />

				<label style="margin:0 6px 0 10px;">Đến ngày</label>
				<input type="date" name="to" value="{$FILTER_TO}" required />

				<label style="margin:0 6px 0 10px;">User</label>
				<select name="user_id">
					<option value="">Tất cả</option>
					{foreach from=$USERS key=UID item=ULABEL}
						<option value="{$UID}" {if $FILTER_USER_ID eq $UID}selected{/if}>{$ULABEL}</option>
					{/foreach}
				</select>

				<button type="submit" class="btn btn-primary" style="margin-left:10px;">Lọc</button>

				{if $FILTER_FROM neq '' && $FILTER_TO neq ''}
					<a class="btn btn-success" style="margin-left:8px;"
						href="index.php?module=Reports&view=ContactFollowupStats&mode=ExportCSV&from={$FILTER_FROM|escape:'url'}&to={$FILTER_TO|escape:'url'}&user_id={$FILTER_USER_ID|escape:'url'}">
						Export CSV
					</a>
					<a class="btn btn-success" style="margin-left:4px;"
						href="index.php?module=Reports&view=ContactFollowupStats&mode=ExportXLS&from={$FILTER_FROM|escape:'url'}&to={$FILTER_TO|escape:'url'}&user_id={$FILTER_USER_ID|escape:'url'}">
						Export Excel
					</a>
				{/if}
			</form>

			{if $ERROR neq ''}
				<div class="alert alert-warning">{$ERROR}</div>
			{/if}

			{if $ROWS|@count gt 0}
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th style="white-space:nowrap;">Tài khoản</th>
							<th style="white-space:nowrap;">Tổng</th>
							{foreach from=$STATUSES item=ST}
								<th style="white-space:nowrap;">{$ST}</th>
							{/foreach}
						</tr>
					</thead>
					<tbody>
						{foreach from=$ROWS item=R}
							<tr>
								<td>{$R.user_label}</td>
								<td><strong>{$R.total}</strong></td>
								{foreach from=$STATUSES item=ST}
									<td>{if isset($R.statuses[$ST])}{$R.statuses[$ST]}{else}0{/if}</td>
								{/foreach}
							</tr>
						{/foreach}
					</tbody>
					<tfoot>
						<tr>
							<td><strong>{$TOTALS.user_label}</strong></td>
							<td><strong>{$TOTALS.total}</strong></td>
							{foreach from=$STATUSES item=ST}
								<td><strong>{if isset($TOTALS.statuses[$ST])}{$TOTALS.statuses[$ST]}{else}0{/if}</strong></td>
							{/foreach}
						</tr>
					</tfoot>
				</table>
			{elseif $ERROR eq '' && $FILTER_FROM neq '' && $FILTER_TO neq ''}
				<div class="alert alert-info">Không có dữ liệu trong khoảng thời gian đã chọn.</div>
			{/if}
		</div>
	</div>
</div>
{/strip}


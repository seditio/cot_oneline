<!-- BEGIN: MAIN -->
<div class="row">
	<div class="col">
		{FILE "{PHP.cfg.themes_dir}/{PHP.cfg.defaulttheme}/warnings.tpl"}

		<!-- BEGIN: ONELINE_SINGLE -->
		<div class="block">
			<h2>{PHP.R.icon-plug}{PHP.L.info_name}</h2>
			<div class="wrapper">
				<form action="{ONELINE_URL_OPEN}" method="post">
					<div class="{PHP.R.admin-table-responsive-container-class}">
						<table class="{PHP.R.admin-table-class}">
							<thead>
								<tr>
									<th class="w-25">{PHP.L.Extrafield}</th>
									<th class="w-75">{PHP.L.Value}</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{PHP.L.Date}:</td>
									<td class="d-flex">{ONELINE_DATE}</td>
								</tr>
								<tr>
									<td>{PHP.L.Text}:</td>
									<td>{ONELINE_TEXT}</td>
								</tr>
								<tr>
									<td>{PHP.L.Section}:</td>
									<td>{ONELINE_SECTION}</td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold fs-6 text-uppercase border-end-0 border-start-0">
										{PHP.L.Extrafields}
									</td>
								</tr>
								<!-- BEGIN: EXTRAFIELDS -->
								<tr>
									<td>{ONELINE_EXTRAFIELD_TITLE}</td>
									<td>{ONELINE_EXTRAFIELD}</td>
								</tr>
								<!-- END: EXTRAFIELDS -->
								<tr>
									<td colSpan="2">
										<a href="{PHP|cot_url('admin', 'm=other&p=oneline')}" class="btn btn-success btn-sm">
											{PHP.R.icon-arrow-left}{PHP.L.oneline_return}
										</a>
										<button type="submit" class="btn btn-primary btn-sm">
											{PHP.R.icon-refresh}{PHP.L.Refresh}
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
		<!-- END: ONELINE_SINGLE -->

		<!-- BEGIN: ONELINE_LIST -->
		<div class="block">
			<h2>{PHP.R.icon-plug}{PHP.L.info_name}</h2>
			<div class="wrapper">
				<form action="{ONELINE_URL_UPDATE}" method="post">
					<div class="{PHP.R.admin-table-responsive-container-class}">
						<div class="d-inline-block mb-3">
							<div class="input-group input-group-sm">
								<label class="input-group-text">{PHP.L.Section}</label>
								{ONELINE_FILTER_SELECT}
								<button type="submit" class="btn {PHP.R.admin-button-primary-class}">{PHP.R.icon-filter}{PHP.L.Filter}</button>
							</div>
						</div>
						<table class="{PHP.R.admin-table-class}">
							<thead>
								<tr>
									<th class="w-25">{PHP.L.Date}</th>
									<th class="w-25">{PHP.L.Text}</th>
									<th class="w-25">{PHP.L.Section}</th>
									<th class="w-25">{PHP.L.Action}</th>
								</tr>
							</thead>
							<tbody>
								<!-- BEGIN: ONELINE_ROW -->
								<tr class="{PHP.R.admin-table-tr-class}">
									<td class="d-flex justify-content-center">{ONELINE_DATE}</td>
									<td>{ONELINE_TEXT}</td>
									<td>
										<div class="input-group">{ONELINE_SECTION}</div>
									</td>
									<td>
										<div class="input-group input-group-sm justify-content-center">
											<a title="{PHP.L.Open}" href="{ONELINE_URL_OPEN}" class="btn {PHP.R.admin-button-primary-class} {PHP.R.admin-button-size-class}">
												{PHP.R.icon-folder-open}{PHP.L.Open}
											</a>
											<span class="input-group-text">#{ONELINE_ID}</span>
											<a title="{PHP.L.Delete}" href="{ONELINE_URL_DELETE}" class="btn {PHP.R.admin-button-danger-class} {PHP.R.admin-button-size-class}">
												{PHP.R.icon-trash}{PHP.L.Delete}
											</a>
										</div>
									</td>
								</tr>
								<!-- END: ONELINE_ROW -->
								<!-- BEGIN: ONELINE_NOROW -->
								<tr>
									<td colspan="4">{PHP.L.None}</td>
								</tr>
								<!-- END: ONELINE_NOROW -->
								<tr>
									<td colspan="4">
										<button type="submit" class="btn {PHP.R.admin-button-primary-class} {PHP.R.admin-top-button-size-class}">
											{PHP.R.icon-refresh}{PHP.L.Update}
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</form>
				<!-- IF {PAGINATION} -->
				<p class="{PHP.R.admin-pagination-p-class}">
					{PHP.L.Total}: {TOTAL_ENTRIES}, <span class="text-lowercase">{PHP.L.Onpage}:</span> {ENTRIES_ON_CURRENT_PAGE}
				</p>
				<nav class="{PHP.R.admin-pagination-nav-class} mt-3" aria-label="Oneline Info Pagination">
					<ul class="pagination {PHP.R.admin-pagination-list-class}">
						{PREVIOUS_PAGE}{PAGINATION}{NEXT_PAGE}
					</ul>
				</nav>
				<!-- ENDIF -->
			</div>
		</div>

		<div class="block">
			<h2>{PHP.R.icon-plus}{PHP.L.Add}</h2>
			<div class="wrapper">
				<form action="{ONELINE_ADDURL}" method="post" name="pageform">
					<table class="table table-bordered">
						<tr>
							<td class="w-25">{PHP.L.Date}</td>
							<td class="w-75 d-flex">{ONELINE_ADDDATE}</td>
						</tr>
						<tr>
							<td>{PHP.L.Text}</td>
							<td>{ONELINE_ADDTEXT}</td>
						</tr>
						<tr>
							<td>{PHP.L.Section}</td>
							<td>{ONELINE_ADDSECTION}</td>
						</tr>
						<tr>
							<td colspan="2">
								<button type="submit" name="rpaste" value="ok" class="btn {PHP.R.admin-button-primary-class}">
									{PHP.R.icon-plus}{PHP.L.Add}
								</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<!-- END: ONELINE_LIST -->
	</div>
</div>
<!-- END: MAIN -->

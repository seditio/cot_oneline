<!-- BEGIN: MAIN -->
<table class="table table-striped">
<!-- BEGIN: PAGE_ROW -->
	<tr>
		<td class="text-center">
			{PAGE_ROW_DATE|cot_date('j F Y', $this)}
		</td>
		<td class="text-center">
			{PAGE_ROW_TEXT}
		</td>
	</tr>
<!-- END: PAGE_ROW -->
</table>

<!-- IF {PAGE_TOP_PAGINATION} -->
<nav aria-label="Oneline Pagination">
	<ul class="pagination justify-content-center mb-0">
		{PAGE_TOP_PAGEPREV}{PAGE_TOP_PAGINATION}{PAGE_TOP_PAGENEXT}
	</ul>
</nav>
<!-- ENDIF -->
<!-- END: MAIN -->

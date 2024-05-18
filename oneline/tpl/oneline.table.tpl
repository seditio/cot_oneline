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

<!-- IF {PAGINATION} -->
<nav aria-label="Oneline Pagination">
	<ul class="pagination justify-content-center mb-0">
		{PREVIOUS_PAGE}{PAGINATION}{NEXT_PAGE}
	</ul>
</nav>
<!-- ENDIF -->
<!-- END: MAIN -->

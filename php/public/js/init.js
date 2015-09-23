function toggleChevron (e) {
	$(e.target)
			.prev('.panel-heading')
			.find("i.indicator")
			.toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
}

$(document).ready(function () {
	$('#accordion').on('hidden.bs.collapse', toggleChevron);
	$('#accordion').on('shown.bs.collapse', toggleChevron);
});


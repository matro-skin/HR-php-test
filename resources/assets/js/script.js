function processAjaxData(response, urlPath){
	document.getElementById("content").innerHTML = response.html;
	document.title = response.pageTitle;
	window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);
}

function loadOrders(path) {
	window.history.pushState(null,'', path);
	$('#orderTabs').addClass('loading');
	axios.get(path)
		.then(response => {
			$('#content').html( response.data.data );
		})
		.finally(() => {
			$('#orderTabs').removeClass('loading');
		})
}

$(document).on('show.bs.tab', '#ordersTab', function (e) {
	let path = $(e.target).attr('href');
	loadOrders(path);
});

$(document).on('click', '#orderTabs a.page-link', function (e) {
	e.preventDefault();
	let path = $(this).attr('href');
	loadOrders(path);
});

$('.needs-validation').each(function(i, form) {
	$(form).on('submit', function(e) {
		if (form.checkValidity() === false) {
			e.preventDefault();
			e.stopPropagation();
		}
		$(form).addClass('was-validated');
	});
});

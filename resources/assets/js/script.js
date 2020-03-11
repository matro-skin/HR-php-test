function processAjaxData(response, urlPath){
	document.getElementById("content").innerHTML = response.html;
	document.title = response.pageTitle;
	window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);
}

function goSync(path) {
	window.history.pushState(null,'', path);
	$('#content > div').addClass('loading');
	axios.get(path)
		.then(response => {
			$('#content').html( response.data.data );
		})
		.finally(() => {
			$('#content > div').removeClass('loading');
		})
}

$(document).on('show.bs.tab', '#ordersTab', function (e) {
	let path = $(e.target).attr('href');
	goSync(path);
});

$(document).on('click', '.pagination a.page-link', function (e) {
	e.preventDefault();
	let path = $(this).attr('href');
	goSync(path);
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

$(document).on('submit', '.productPrice', function (e) {
	e.preventDefault();
	let form = $(this),
		path = form.attr('action'),
		btn = form.find('[type="submit"]'),
		fd = form.serialize();
	btn.prop('disabled', true);
	axios.post(path, fd)
		.then(response => {
			$.notify({
				message: response.data.message
			});
		})
		.catch(error => {
			$.each(error.response.data.errors, function (label, message) {
				$.notify({
					message: message
				}, {
					type: 'danger'
				});
			})
		})
		.finally(() => {
			btn.prop('disabled', false);
			form.removeClass('was-validated');
		});
});

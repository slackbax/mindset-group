function getDateBD(date) {
	var aux = date.split('-');
	return aux[2] + '/' + aux[1] + '/' + aux[0];
}

function getDateHourBD(date) {
	var aux = date.split(' ');
	var aux2 = aux[0].split('-');
	return aux2[2] + '/' + aux2[1] + '/' + aux2[0] + ' ' + aux[1];
}

function getMonthDate(date) {
	var aux = date.split('-');
	months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

	var month = months[aux[1] - 1];
	var year = aux[0];
	date = month + " de " + year;
	return date;
}

function getTodayDate() {
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth() + 1;
	var yyyy = today.getFullYear();

	if (dd < 10) {
		dd = '0' + dd;
	}

	if (mm < 10) {
		mm = '0' + mm;
	}

	return dd + '/' + mm + '/' + yyyy;
}

function getExt(file) {
	return file.split('.').pop().toLowerCase();
}

function accentDecode(tx) {
	var rp = String(tx);
	rp = rp.replace(/&aacute;/g, 'á');
	rp = rp.replace(/&eacute;/g, 'é');
	rp = rp.replace(/&iacute;/g, 'í');
	rp = rp.replace(/&oacute;/g, 'ó');
	rp = rp.replace(/&uacute;/g, 'ú');
	rp = rp.replace(/&ntilde;/g, 'ñ');
	rp = rp.replace(/&uuml;/g, 'ü');
	rp = rp.replace(/&Aacute;/g, 'Á');
	rp = rp.replace(/&Eacute;/g, 'É');
	rp = rp.replace(/&Iacute;/g, 'Í');
	rp = rp.replace(/&Oacute;/g, 'Ó');
	rp = rp.replace(/&Uacute;/g, 'Ú');
	rp = rp.replace(/&Ñtilde;/g, 'Ñ');
	rp = rp.replace(/&Üuml;/g, 'Ü');
	rp = rp.replace(/&nbsp;/g, ' ');
	rp = rp.replace(/&quot;/g, '"');
	rp = rp.replace(/&ndash;/g, "-");
	rp = rp.replace(/&apos;/g, "'");
	rp = rp.replace(/&lt;/g, "<");
	rp = rp.replace(/&gt;/g, ">");
	rp = rp.replace(/&amp;/g, "&");
	rp = rp.replace(/&euro;/g, "€");
	rp = rp.replace(/&iexcl;/g, "¡");
	rp = rp.replace(/&deg;/g, "°");
	return rp;
}

function number_format(number, decimals, dec_point, thousands_sep) {
	number = (number + '')
		.replace(/[^0-9+\-Ee.]/g, '');

	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
		s = '',
		toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec);
			return '' + (Math.round(n * k) / k)
				.toFixed(prec);
		};

	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
		.split('.');
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '')
		.length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1)
			.join('0');
	}
	return s.join(dec);
}

$.fn.clearForm = function () {
	return this.each(function () {
		var type = this.type, tag = this.tagName.toLowerCase();
		if (tag === 'form')
			return $(':input', this).clearForm();
		if (type === 'text' || type === 'password' || tag === 'textarea' || tag === 'email')
			this.value = '';
		else if (type === 'checkbox' || type === 'radio')
			this.checked = false;
		else if (tag === 'select')
			this.selectedIndex = -1;
	});
};

$.fn.datepicker.defaults.language = 'es';
$.fn.datepicker.defaults.orientation = 'bottom left';
$.fn.datepicker.defaults.autoclose = true;

$.extend($.fn.dataTable.defaults, {
	'dom': "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" + "<'row'<'col-xs-12't>>" + "<'row'<'col-sm-6'i><'col-sm-6'p>>",
	'buttons': ['excel'],
	//'scrollX': true,
	'paging': true,
	'lengthChange': true,
	'searching': true,
	'ordering': true,
	'info': true,
	'autoWidth': false,
	'language': {'url': 'bower_components/datatables.net/Spanish.json'},
	'order': [[0, 'asc']],
	'lengthMenu': [[20, 50, 100, -1], [20, 50, 100, 'Todo']],
	'pageLength': 20
});

$.fn.dataTable.moment = function ( format, locale ) {
	var types = $.fn.dataTable.ext.type;

	// Add type detection
	types.detect.unshift( function ( d ) {
		return moment( d, format, locale, true ).isValid() ?
			'moment-'+format :
			null;
	} );

	// Add sorting method - use an integer for the sorting
	types.order[ 'moment-'+format+'-pre' ] = function ( d ) {
		return moment( d, format, locale, true ).unix();
	};
};

$.fn.dataTable.moment( 'DD/MM/YYYY' );

Noty.overrideDefaults({
	layout: 'topRight',
	theme: 'metroui',
	timeout: 3000,
	killer: true,
	closeWith: ['click']
});

$(document).on('change', '.input-number', function () {
	this.value = this.value.replace(/[^0-9]+/g, '');
	if (this.value < 0) this.value = '';
});
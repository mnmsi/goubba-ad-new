
function loadUserDataIntoMorrisChart(data) {
    new Morris.Donut({
		element: 'morrisBar8',
		data: data,
		backgroundColor: 'rgba(119, 119, 142, 0.2)',
		labelColor: '#77778e',
		colors: ['#0774f8', '#d43f8d', '#09ad95'],
		formatter: function(x) {
			return x + "%"
		}
	}).on('click', function(i, row) {
		console.log(i, row);
	});
}

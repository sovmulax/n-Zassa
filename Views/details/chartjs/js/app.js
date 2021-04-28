$(document).ready(function(){
	$.ajax({
		url: "http://code/Views/details/chartjs/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var player = [];
			var score = [];

			for(var i in data) {
				player.push(data[i].mois);
				score.push(data[i].score);
			}

			var chartdata = {
				labels: player,
				datasets : [
					{
						label: 'Nombre d\'emprunt',
						backgroundColor: 'rgba(0, 128, 128, 0.75)',
						borderColor: 'rgba(0, 128, 128, 0.75)',
						hoverBackgroundColor: 'rgba(0, 128, 128, 1)',
						hoverBorderColor: 'rgba(0, 128, 128, 1)',
						data: score
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
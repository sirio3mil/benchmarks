$(function(){
	var divs = {
		principal: $('#contenedor-principal'),
		panels: []
	};
	var files = [];
	var times = [];

	function DevolverListadoTests(){
		return $.ajax({
			url: "serverside/operaciones_tests.php?action=DevolverListadoTests",
			async: true,
			beforeSend: function(){
				$.block();
			},
			complete: function(){
				$.unblockUI();
			},
			contentType: "application/x-www-form-urlencoded",
			dataType: "json"
		});
	}

	function EjecutarTests(){
		if(!files.length){
			return false;
		}
		filename = files.shift();
		if(!filename){
			return false;
		}
		$.ajax({
			type: "POST",
			url: "serverside/operaciones_tests.php?action=EjecutarTest",
			data: {
				test: filename
			},
			async: true,
			beforeSend: function(){
				$.block();
			},
			complete: function(){
				$.unblockUI();
			},
			contentType: "application/x-www-form-urlencoded",
			dataType: "json",
			success: function(json){
				if(json.error){
					$.alert(json.error);
				}
				else{
					var pos = DevolverCoordenadas(filename);
					var id = DevolverContenedorId(pos);
					var group = pos[0];
					$('<div class="row test-executed"><div class="col-md-2 text-center"><div class="elapsed-time-percent"></div></div><div class="col-md-6">' + json.title + '</div><div class="col-md-4 text-right">' + Math.round(json.elapsed * 1000000) + ' µs</div></div>').attr({
						id: id,
						'data-elapsed': json.elapsed,
						'data-group': group,
						'data-test': pos[1]
					}).appendTo(divs.panels[group]);
					if(!times[group]){
						times[group] = [];
					}
					times[group][pos[1]] = json.elapsed;
					if(files.length){
						EjecutarTests();
					}
					else{
						ResumenTests();
					}
				}
			}
		});
	}

	function ResumenTests(){
		$.each(times, function(group, tests){
			if(tests && tests.length){
				var min = 1000000;
				$.each(tests, function(test, elapsed){
					if(elapsed){
						if(elapsed < min){
							min = elapsed;
						}
					}
				});
				$.each(tests, function(test, elapsed){
					if(elapsed){
						var percent = Math.round(elapsed * 100 / min);
						var id = DevolverContenedorId([group, test]);
						var cls = 'success';
						if(percent === 100){
							cls = 'info';
						}
						else if(percent > 150 && percent < 300){
							cls = 'warning';
						}
						else if(percent >= 300){
							cls = 'danger';
						}
						$('#' + id).find('div.elapsed-time-percent').html(percent + ' %').addClass('label label-' + cls);
					}
				});
			}
		});
	}

	function DevolverCoordenadas(filename){
		var re = /\d+/g;
		return filename.match(re);
	}

	function DevolverContenedorId(pos){
		return pos[0] + '_' + pos[1];
	}

	$.when(DevolverListadoTests()).then(function(json){
		if(json.error){
			$.alert(json.error);
		}
		else if(json.files.length){
			$.each(json.files, function(key, filename){
				var pos = DevolverCoordenadas(filename);
				var group = pos[0];
				if(!divs.panels[group]){
					divs.panels[group] = $('<div class="panel panel-default"><div class="panel-body"></div></div>').appendTo(divs.principal).children('div.panel-body');
				}
				files.push(filename);
			});
			if(files.length){
				EjecutarTests();
			}
		}
	});
});
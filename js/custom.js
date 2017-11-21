$.extend({
	alert: function(message, title, callback){
		title = title || 'Alerta';
		BootstrapDialog.show({
			type: BootstrapDialog.TYPE_DANGER,
			title: title,
			message: message,
			buttons: [{
				label: 'Ok',
				cssClass: 'btn-default',
				action: function(dialogRef){
					if(callback){
						callback();
					}
					dialogRef.close();
				}
			}]
		});
	},
	block: function(t){
		t || (t = "Enviando datos...");
		$.blockUI({
			message: "<i class='fa fa-spinner fa-spin'></i> " + t,
			css: {
				border: 'none',
				padding: '15px',
				backgroundColor: '#000',
				opacity: .7,
				color: '#fff',
				'font-weight': 'bold'
			},
			overlayCSS: {
				backgroundColor: '#c5d0f4',
				opacity: .3
			}
		});
	}
});
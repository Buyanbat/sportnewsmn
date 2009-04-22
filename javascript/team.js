var Team = {
	ChangeType : function() {
		val = document.getElementById('team_type').value;
		Element.show('spinner')
		new Ajax.Updater('team_box','add/'+val,
							{asynchronous:true, evalScripts:true,
								onSuccess:function(request){
									Element.hide('spinner');
								}
							});
	},
};

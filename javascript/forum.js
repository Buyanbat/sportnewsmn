

var Forum = {
		FID: 0,
		RID : 0,
		RBox : null,
		ReplyRequest : function(rid){
			this.RBox = $('replyBox');
			this.RBox.style.left = "300px"
			this.RBox.style.top = document.getElementById('cursor_y').value-50+"px";
			this.RBox.style.display = "block";
			new Draggable("replyBox");
			document.getElementById('rid').value=rid;
			this.FID = fid;
			this.RID = rid;
		},
		Close : function(){
			FCKeditorAPI.GetInstance('reply').SetHTML("");
			Effect.Fade("replyBox",{duration: 0.5});
			this.RID = 0;
		},
		Up : function(rid){
			new Ajax.Updater("rup_"+rid,site_url()+"/forum/up/"+rid,{
				assyncrounous: true,
				evalscript: true,
			});
		},
		Down : function(rid){
			new Ajax.Updater("rdown_"+rid,site_url()+"/forum/down/"+rid,{
				assyncrounous: true,
				evalscript: true,
			});
		}
};



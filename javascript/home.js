var Face = {
	Current : 0,
	Timer : null,
	Next : function(){
		if(this.Current < 5){
			$("face_ctl_"+this.Current).setAttribute('class','face_ctl');
			this.Current++;
			new Effect.Opacity('face_inner', {from: 0, to: 1 });
			var HTML = $("inner_"+this.Current).innerHTML;
			$("face_inner").innerHTML = HTML;
			$("face_ctl_"+this.Current).setAttribute('class','face_ctl_cur');
		}else {
			$("face_ctl_"+this.Current).setAttribute('class','face_ctl');
			this.Current = 1;
			var HTML = $("inner_"+this.Current).innerHTML;
			$("face_inner").innerHTML = HTML;
			new Effect.Opacity('face_inner', {from: 0, to: 1 });
			$("face_ctl_"+this.Current).setAttribute('class','face_ctl_cur');
		}
	},
	Touch : function(id){
		if(this.Current != id){
			clearInterval(this.Timer);
			if(this.Current != 0){
				$("face_ctl_"+this.Current).setAttribute('class','face_ctl');
			}
			new Effect.Opacity('face_inner', {from: 0, to: 1 });
			var HTML = $("inner_"+id).innerHTML;
			$("face_inner").innerHTML = HTML;
			this.Current = id;
			$("face_ctl_"+this.Current).setAttribute('class','face_ctl_cur');
			this.Timer = setInterval("Face.Next()",5000);
			
		}
	},
	Init : function(){
		this.Touch(1);
	}
};

/*-----------------------------------------------------------
    Toggles element's display value
    Input: any number of element id's
    Output: none 
    ---------------------------------------------------------*/
function toggleDisp() {
    for (var i=0;i<arguments.length;i++){
        var d = $(arguments[i]);
        if (d.style.display == 'none')
            d.style.display = 'block';
        else
            d.style.display = 'none';
    }
}
/*-----------------------------------------------------------
    Toggles tabs - Closes any open tabs, and then opens current tab
    Input:     1.The number of the current tab
                    2.The number of tabs
                    3.(optional)The number of the tab to leave open
                    4.(optional)Pass in true or false whether or not to animate the open/close of the tabs
    Output: none 
    ---------------------------------------------------------*/
function toggleTab(num,numelems,opennum,animate) {
    if ($('tabContent'+num).style.display == 'none'){
        for (var i=1;i<=numelems;i++){
            if ((opennum == null) || (opennum != i)){
                var temph = 'tabHeader'+i;
                var h = $(temph);
                if (!h){
                    var h = $('tabHeaderActive');
                    h.id = temph;
                }
                var tempc = 'tabContent'+i;
                var c = $(tempc);
                if(c.style.display != 'none'){
                    if (animate || typeof animate == 'undefined')
                        Effect.toggle(tempc,'blind',{duration:0.5, queue:{scope:'menus', limit: 3}});
                    else
                        toggleDisp(tempc);
                }
            }
        }
        var h = $('tabHeader'+num);
        if (h)
            h.id = 'tabHeaderActive';
        h.blur();
        var c = $('tabContent'+num);
        c.style.marginTop = '2px';
        if (animate || typeof animate == 'undefined'){
            Effect.toggle('tabContent'+num,'blind',{duration:0.5, queue:{scope:'menus', position:'end', limit: 3}});
        }else{
            toggleDisp('tabContent'+num);
        }
    }
}


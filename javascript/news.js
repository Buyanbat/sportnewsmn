var News = {
		totalImg: 0,
		ImgInsertNum : 1,
		CatInsertNum : 1,
		addImg : function(){
			this.ImgInsertNum++;
			newImg = document.createElement('input');
			newImg.setAttribute('type',"file");
			newImg.setAttribute('id',"img_"+this.ImgInsertNum);
			newImg.setAttribute('name',"img_"+this.ImgInsertNum);
			newImg.setAttribute('style',"width: 500px;display: none;margin-left: 78px");
			$("addImg").appendChild(newImg);
			Effect.Appear("img_"+this.ImgInsertNum,{duration:0.5});
			$("imgNum").value=this.ImgInsertNum;
		},
		rmImg : function(){
			if(this.ImgInsertNum > 1){
				lastImg = $("img_"+this.ImgInsertNum);
				Effect.Fade("img_"+this.ImgInsertNum);
				$("addImg").removeChild(lastImg);
				this.ImgInsertNum--;
				$("imgNum").value=this.ImgInsertNum;
			}
		},
		addCat : function(){
			this.CatInsertNum++;
			new Ajax.Updater('addCat',site_url()+"/news/add_cat/"+this.CatInsertNum,{
				insertion:Insertion.Bottom,
			});
			$("catNum").value=this.CatInsertNum;
		},
		rmCat : function(){
			if(this.CatInsertNum > 1){
				lastCat = $("cat_"+this.CatInsertNum);
				$("addCat").removeChild(lastCat);
				this.CatInsertNum--;
				$("catNum").value=this.CatInsertNum;
			}
		},
		MaxImg : null,
		CurrImg : 1,
		CurrImgTop: 0,
		sleeping : true,
		nextImg : function(){
			this.MaxImg = $("MaxImg").value;
			if(this.CurrImg < this.MaxImg){
				this.CurrImg++;
				new Effect.Move("pic_inner",{duration: 0.4, y: -300, x: 0, mode: 'relative'})
			}
		},
		prevImg : function(){
			if(this.CurrImg > 1){
				this.CurrImg--;
				new Effect.Move("pic_inner",{duration: 0.4, y: 300, x: 0, mode: 'relative'})
				
			}
		},
	
}

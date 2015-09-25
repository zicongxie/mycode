var  Waterfall=function(opts){
	    	var defaults={
	    		Hbottom:30,
	    		id: null 
	    	};
	    	 this.opts=$.extend(defaults,opts);
	    	return this._init();
	    }
	    Waterfall.prototype = {
		    _init:function(){
		    	this.opts.Hbottom=parseInt(this.opts.Hbottom);
		    	var t;
		    	this.OList=$('#list');
		    	Odl=this.OList.find('dl');
		    	Odl.css({'opacity':'1','display':'inline-block'});
		    	Odl.eq(0).css({'top':0,'left':'20px','opacity':'1'});
		    	Odl.eq(1).css({'top':0,'right':'20px','opacity':'1'});
		    	this.odd=Odl.eq(0).height()+this.opts.Hbottom;
		    	this.even=Odl.eq(1).height()+this.opts.Hbottom;
		    	return this._resolve();
		    },
		    _resolve:function(){
				for (var i = 2; i < Odl.length; i++) {
							if (this.odd>this.even) this.Mheight=this.odd;
							else this.Mheight=this.even;
							this.OList.css("height",this.Mheight+'px');
							/*console.log(this.odd,this.even,this.Mheight,Odl.eq(i).height());*/
							if(this.odd<this.even){
								Odl.eq(i).css({'top':this.odd+'px','left':'20px','opacity':'1'});
								this.odd = parseInt(this.odd)+Odl.eq(i).height()+this.opts.Hbottom; //奇数
							}else{
								Odl.eq(i).css({'top':this.even+'px','right':'20px','opacity':'1'});
								this.even+=(Odl.eq(i).height()+this.opts.Hbottom); //偶数
							}
						
						 // };
					};
					/*this.Mheight= this.odd>this.even?this.odd:this.oven;
					this.OList.css("height",this.Mheight+'px');	*/
		    }	
	    };
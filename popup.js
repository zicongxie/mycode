function popup(config){
		var oShadow=document.getElementById('shadow'),
			oClose=attrGetObj('id','close'),
			oPop=attrGetObj('pop'),
			oId=attrGetObj('id'),oTemp;
			for (var i = 0; i < oPop.length; i++) {
				oPop[i].onclick=function(){
					for (var j = 0; j < oId.length; j++) {
						 if (oId[j].getAttribute('id')==this.getAttribute('pop')) {
						 	shadowToggle(oId[j],55);
						 	makeCenter(oId[j]);
						 	oTemp=oId[j];
						 };
					};
				};
			};
			for (var k = 0; k < oClose.length; k++) {
				oClose[k].onclick=oShadow.onclick=function(){
				shadowToggle(oTemp,0);
				};
			};
			
	}
/*
*@param:object obj //需要开关的Dom
*/
	function shadowToggle(obj,opacityTarget){
		var	oShadow=document.getElementById('shadow');
		    oShadow.aleft=obj.offsetLeft;
		if(oShadow.aleft>-1000){
			// moveSlow(oShadow,opacityTarget);
			// oShadow.style.left='999999px';
			obj.style.left='-999999px';
			oShadow.style.left='999999px';
			oShadow.style.opacity=0;
			oShadow.style.filter='alpha(opacity=0)';
			
		}else{
			oShadow.style.left='0';
			oShadow.style.opacity=0.55;
			oShadow.style.filter='alpha(opacity=55)';
			// moveSlow(oShadow,opacityTarget);
		}
	}
	/*function moveSlow (obj,target) {
		var opac;
		clearInterval(obj.timer);
		obj.timer=setInterval(function(){
		obj.speed=(obj.style.opacity*100-target)/8;
		obj.speed=obj.speed>0?Math.ceil(obj.speed):Math.floor(obj.speed);
		if (parseInt(obj.style.opacity*100)==target){
			if (obj.aleft>-1000) {
			obj.style.display='none';
			}
			clearInterval(obj.timer);
		}else{
			opac=Math.floor(obj.style.opacity*10000)/100-obj.speed;
			 console.log(obj.speed);
			obj.style.opacity=opac/100;
			obj.style.filter='alpha(opacity='+opac+')';
		}
		},10);
	}*/

	function attrGetObj(attr,value){
		var returnArr=[],
		    oDoc=document.getElementsByTagName('*');
			for (var p = 0; p < oDoc.length; p++) {
				if (value==null) {
					if (oDoc[p].getAttribute(''+attr+'')!=null)
					returnArr.push(oDoc[p]);
				}else{
					if (oDoc[p].getAttribute(''+attr+'')==value)
					returnArr.push(oDoc[p]);
				}
			};
		return returnArr;
	}
	function makeCenter(obj){
		      obj.style.marginLeft= -(obj.offsetWidth/2)+'px';
		      obj.style.marginTop= -(obj.offsetHeight/2)+'px';
		      obj.style.left='50%';
		      obj.style.top= '50%';
	}
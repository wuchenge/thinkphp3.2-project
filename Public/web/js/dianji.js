// JavaScript Document
 var pin=document.getElementById('dianji');
  var pin1=document.getElementById('dianji1');
  var dian=document.getElementById('dianji2');
  var dian1=document.getElementById('dianji3');
  var bao=document.getElementById('dianji4');
  var bao1=document.getElementById('dianji5');
  var zhao=document.getElementById('dianji6');
  var zhao1=document.getElementById('dianji7');
  pin.onclick=function(){
	  pin1.style.display="block";
	  dian1.style.display='none';
	  bao1.style.display='none';
	   zhao1.style.display='none';
	  }
	   dian.onclick=function(){
		pin1.style.display="none";
	  dian1.style.display='block';
	  bao1.style.display='none';
	   zhao1.style.display='none';
	  }
	  	   bao.onclick=function(){
			   pin1.style.display="none";
	  dian1.style.display='none';
	  bao1.style.display='block';
	   zhao1.style.display='none';
	  }
  	  	  zhao.onclick=function(){
			  pin1.style.display="none";
	  dian1.style.display='none';
	  bao1.style.display='none';
	   zhao1.style.display='block';
	  }
// JavaScript Document
  var aa=document.getElementById("zhaopin2")
  var bb=document.getElementById("zhaopin3")
  var cc=document.getElementById("zhaopin4")
    var dd=document.getElementById("zhaopin7")
  var ee=document.getElementById("zhaopin8")
  var ff=document.getElementById("zhaopin9")
    aa.onclick=function(){
		aa.style.display = 'block';
		bb.style.display = 'none';
		cc.style.display = 'none';
		}
		   bb.onclick=function(){
		aa.style.display = 'block';
		bb.style.display = 'none';
		cc.style.display = 'none';
		}
		   dd.onclick=function(){
		dd.style.display = 'none';
		ee.style.display = 'block';
		ff.style.display = 'block';
		}
			   ee.onclick=function(){
		dd.style.display = 'block';
		ee.style.display = 'none';
		ff.style.display = 'none';
		}
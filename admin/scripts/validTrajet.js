// JavaScript Document

function valid(numTrajet, emedm){
	
	var id_chauffeur = document.getElementById('chauffeur' + numTrajet).value;
	var id_vehicule = document.getElementById('vehicule' + numTrajet).value;
	
	ajax.post("index.php?p=2","refresh","numTrajet="+numTrajet+"&emedm="+emedm+"&idC="+id_chauffeur+"&idV="+id_vehicule);
	
	document.getElementById('estValide_'+numTrajet).value = '1';
	
	rafraichirColorPanel(numTrajet);
}

// pour re validé un trajet (rajout sur navette validée)
function valid2(numTrajet, idC, idV){
	

	ajax.post("index.php?p=2","refresh","numTrajet="+numTrajet+"&emedm=1&idC="+idC+"&idV="+idV);
	
	document.getElementById('estValide_'+numTrajet).value = '1';
	
	rafraichirColorPanel2(numTrajet);
}


function rafraichirColorPanel(num){
	document.getElementById("btn_valid"+num).style.display="none";
	document.getElementById("chauffeur"+num).style.display="none";
	document.getElementById("vehicule"+num).style.display="none";
	document.getElementById("changer"+num).style.display="none";
	document.getElementById("barre"+num).style.backgroundColor = "#0C3";
}


function rafraichirColorPanel2(num){
	document.getElementById("btn_valid"+num).style.display="none";
	document.getElementById("barre"+num).style.backgroundColor = "#0C3";
}





function $(e){if(typeof e=='string')e=document.getElementById(e);return e};
function collect(a,f){var n=[];for(var i=0;i<a.length;i++){var v=f(a[i]);if(v!=null)n.push(v)}return n};
     
ajax={};
ajax.x=function(){try{return new ActiveXObject('Msxml2.XMLHTTP')}catch(e){try{return new ActiveXObject('Microsoft.XMLHTTP')}catch(e){return new XMLHttpRequest()}}};
ajax.serialize=function(f){var g=function(n){return f.getElementsByTagName(n)};var nv=function(e){if(e.name)return encodeURIComponent(e.name)+'='+encodeURIComponent(e.value);else return ''};var i=collect(g('input'),function(i){if((i.type!='radio'&&i.type!='checkbox')||i.checked)return nv(i)});var s=collect(g('select'),nv);var t=collect(g('textarea'),nv);return i.concat(s).concat(t).join('&');};
ajax.send=function(u,f,m,a){var x=ajax.x();x.open(m,u,true);x.onreadystatechange=function(){ if(x.readyState==4)eval(x.responseText); };if(m=='POST')x.setRequestHeader('Content-type','application/x-www-form-urlencoded');x.send(a)};
ajax.post=function(url,func,args){ajax.send(url,func,'POST',args)};

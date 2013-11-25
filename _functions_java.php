<script language="JavaScript"> // Помощь для IE правильно воспроизовдить css-menu
function cssmenuhover()
{
        if(!document.getElementById("cssmenu"))
		return;
				var lis = document.getElementById("cssmenu").getElementsByTagName("LI");
					for (var i=0;i<lis.length;i++)
					 {
					 lis[i].onmouseover=function(){this.className+=" iehover";}
	                 lis[i].onmouseout=function() {this.className=this.className.replace(new RegExp(" iehover\\b"), "");}
			         }
}
																						 

if (window.attachEvent)
     window.attachEvent("onload", cssmenuhover);
</script>


<SCRIPT LANGUAGE="JavaScript">
function setCookie(name, value, expiredays, path, domain, secure) {
   if (expiredays) {
      var exdate=new Date();
      exdate.setDate(exdate.getDate()+expiredays);
      var expires = exdate.toGMTString();
   }
   document.cookie = name + "=" + escape(value) +
   ((expiredays) ? "; expires=" + expires : "") +
   ((path) ? "; path=" + path : "") +
   ((domain) ? "; domain=" + domain : "") +
   ((secure) ? "; secure" : "");
}
</script>


<SCRIPT LANGUAGE="JavaScript">
function openblock(id) {
	if(document.getElementById(id).style.display=='none') {
		document.getElementById(id).style.display='';
		} 
		else {
		document.getElementById(id).style.display='none';
		}
}
</script>



<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>









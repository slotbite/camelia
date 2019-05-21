<html> 
<head> 
<script> 
function tabular(e,obj) { 
  tecla=(document.all) ? e.keyCode : e.which; 
  if(tecla!=13) return; 
  frm=obj.form; 
  for(i=0;i<frm.elements.length;i++) 
    if(frm.elements[i]==obj) { 
      if (i==frm.elements.length-1) i=-1; 
      break } 
  frm.elements[i+1].focus(); 
  return false; 
} 
</script> 
</head> 
<body> 
<form> 
<input type="text" onkeypress="return tabular(event,this)" /> 
<input type="text" onkeypress="return tabular(event,this)" /> 
</form> 
</body> 
</html>  
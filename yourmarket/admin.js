//ON PEUT RETIRER
	window.onload = function(){
    document.getElementsByName("removeseller").onclick = function(){
		alert("TEEEEEEEEEEEEEEEST");
        document.getElementsByName("postvar").value = this.value;
        document.forms.myform.submit();
		}
	};
	
	function test(){
		alert("TEEEEEEEEEEEEEEEST");
	};
//----------------------------------------	
	function removeseller(val){
		alert("TRYING TO REMOVE A SELLER");
		alert(val);
		document.getElementById("userid").value = val;
		alert("POSTVAR :"+document.getElementById("userid").value);
		document.forms.myform.submit();
		};
//ON PEUT RETIRER		
		function display(){
			alert("LA valeur de postvar pour le moment est "+ document.getElementById("userid").value);
		};
//----------------------------------------		
		function removeitem(val){
		alert("TRYING TO REMOVE AN ITEM");
		alert(val);
		document.getElementById("itemid").value = val;
		alert("POSTVAR :"+document.getElementById("itemid").value);
		document.forms.myformitem.submit();
		};
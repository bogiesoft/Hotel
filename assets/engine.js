function serialize(obj, prefix) {
  var str = [];
  for(var p in obj) {
    var k = prefix ? prefix + "[" + p + "]" : p, v = obj[p];
    str.push(typeof v == "object" ?
      serialize(v, k) :
      encodeURIComponent(k) + "=" + encodeURIComponent(v));
  }
  return str.join("&");
}
function calcHeight(obj){
	obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
}


function initializeEngine(element,params){
	var elem = document.getElementById(element);
	var ifrm = "<iframe src='http://proje.dev/login/?"+serialize(params)+"' frameBorder='0' scrolling='no' width='100%' height='100%'>";
	/*
	ifrm = document.createElement("IFRAME");
	ifrm.setAttribute("src", "http://bencagri.com/?"+serialize(params));
	ifrm.style.width = '100%';
	ifrm.style.height = '100%';
	document.body.appendChild(ifrm);
	*/
	elem.innerHTML = ifrm;

	console.log(ifrm);
}
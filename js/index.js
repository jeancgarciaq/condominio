/*+++###  BUSCAR INMUEBLE ###+++*/
function buscarCondominio() {

  var busquedaCondominio;
  if(window.XMLHttpRequest){busquedaCondominio = new XMLHttpRequest();} 
  else {busquedaCondominio = new ActiveXObject("Microsfot.XMLHTTP");}

  var busqueda = document.getElementById("inputCondominio").value;
  var buscarC = "busqueda=" + busqueda;

    busquedaCondominio.onreadystatechange = function()  {
    if(this.readyState === 4 && this.status === 200) {          
        
          document.getElementById("resultado").innerHTML = this.responseText;

      }
    }
    busquedaCondominio.open("POST", "bcondominio.php", true);
    busquedaCondominio.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    busquedaCondominio.send(buscarC); 

}

/*+++###  BUSCAR INMUEBLE REPETIDOS ###+++*/
function buscarRepetidos() {

  var busquedaInmueble;
  if(window.XMLHttpRequest){busquedaInmueble = new XMLHttpRequest();} 
  else {busquedaInmueble = new ActiveXObject("Microsfot.XMLHTTP");}

  var busqueda = document.getElementById("busqueda").value;
  var buscarI = "busqueda=" + busqueda;

    busquedaInmueble.onreadystatechange = function()  {
    if(this.readyState === 4 && this.status === 200) {          
        
          document.getElementById("resultado").innerHTML = this.responseText;

      }
    }
    busquedaInmueble.open("POST", "repetidos.php", true);
    busquedaInmueble.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    busquedaInmueble.send(buscarI); 

}

/*+++### BOTON IR ARRIBA ###+++*/
//<![CDATA[
// Plugin: scrollToTop
// by zkreations.com | Daniel Abel
  var scrollToTop = (function() {
    var showButton = 600,
    scrollSpeed = 1000; 
    function scrollTop(b) {
        function a(d) {
          c += Math.PI / (b / (d - e));
          c >= Math.PI && window.scrollTo(0, 0);
          0 !== window.scrollY && (window.scrollTo(0, Math.round(scrollTime + scrollTime * Math.cos(c))), e = d, window.requestAnimationFrame(a))
        }
        var scrollTime = window.scrollY / 2,
            c = 0,
            e = performance.now();
            window.requestAnimationFrame(a)
      }
      var scrollPosition = window.scrollY,
          scrollButton = document.getElementById("scrollToTop");
      window.addEventListener("scroll", function() {
          scrollPosition = window.scrollY;
          showButton < scrollPosition ? scrollButton.classList.add("visible") : scrollButton.classList.remove("visible")
        });
      scrollButton.onclick = function() {
        scrollTop(scrollSpeed)
            }
  })();
//]]>

/*+++###  RESALTAR PALABRAS ###+++*/
/*window.onload = function(){

                //---Función de realizar la búsqueda
                function searchInText( word, html ) {

                    //---Eliminar los spans
                    html = html.replace(/<span class="finded">(.*?)<\/span>/g, "$1");

                    //---Crear la expresión regular que buscará la palabra
                    var reg = new RegExp(word.replace(/[\[\]\(\)\{\}\.\-\?\*\+]/, "\\$&"), "gi");
                    var htmlreg = /<\/?(?:a|b|br|em|font|img|p|span|strong)[^>]*?\/?>/g;

                    //---Añadir los spans
                    var array;
                    var htmlarray;
                    var len = 0;
                    var sum = 0;
                    var pad = 28 + word.length;

                    while ((array = reg.exec(html)) != null) {

                        htmlarray = htmlreg.exec(html);
                 
                        //---Verificar si la búsqueda coincide con una etiqueta html
                        if(htmlarray != null && htmlarray.index < array.index && htmlarray.index + htmlarray[0].length > array.index + word.length){

                            reg.lastIndex = htmlarray.index + htmlarray[0].length;

                            continue;

                        }

                        len = array.index + word.length;

                        html = html.slice(0, array.index) + "<span class='finded'>" + html.slice(array.index, len) + "</span>" + html.slice(len, html.length);

                        reg.lastIndex += pad;

                        if(htmlarray != null) htmlreg.lastIndex = reg.lastIndex;
                        
                        sum++;

                    }

                    return {total: sum, html: html};

                }

                //---Al presionar el botón de buscar
                document.getElementById("boton").addEventListener("click", function(){

                    var search = document.getElementById("busqueda").value;

                    if(search.length == 0) return;

                    var props = searchInText( search, document.getElementById("resultado").innerHTML );
                    
                    document.getElementById("results").innerHTML = (props.total > 0) ? "Veces encontradas: " + props.total : "No se ha encontrado";
                    
                    if(props.total > 0) document.getElementById("resultado").innerHTML = props.html;

                });

            }*/
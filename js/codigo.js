/*	
	Archivo encargado de gestionar las acciones de la tabla, como la edición de celdas y la actualización de la base de datos.
*/

let celdas = document.querySelectorAll("td");

celdas.forEach(function (celda) {
  celda.ondblclick = function () {
    console.log("ok has hecho doble click");
    this.setAttribute("contenteditable", "true");
    this.classList.add("celdaactiva");
    this.focus();
  };
  celda.onblur = function () {
    this.setAttribute("contenteditable", "false");
    this.classList.remove("celdaactiva");
    let contenido = this.textContent;
    let tabla = this.getAttribute("tabla");
    let columna = this.getAttribute("columna");
    let identificador = this.getAttribute("identificador");
    fetch(
      "actualizar.php?tabla=" +
        encodeURI(tabla) +
        "&columna=" +
        encodeURI(columna) +
        "&identificador=" +
        encodeURI(identificador) +
        "&contenido=" +
        encodeURI(contenido) +
        ""
    );
  };
});

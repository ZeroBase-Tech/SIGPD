
function mostrarAlerta(mensaje) {
  const contenedor = document.getElementById("alert-container");

  const alerta = document.createElement("div");
  alerta.className = "alert alert-danger text-center";
  alerta.role = "alert";
  alerta.textContent = mensaje;

  contenedor.innerHTML = "";
  contenedor.appendChild(alerta);

  setTimeout(() => {
    alerta.remove();
  }, 2000);
}


let Diferencia = new Array(6);
let Igualdad;
let Trio;
// Limites por casilla (id de la casilla: cantidad máxima)
const limites = {
  Semejanza: 6,
  Rey: 1,
  Trio: 3,
  Diferencia: 6,
  Isla: 1,
  Amor: 12,
  Rio: 12,
};

// Activar drag en todas las fichas
const fichas = document.querySelectorAll(".ficha");
fichas.forEach((ficha) => {
  ficha.addEventListener("dragstart", (e) => {
    e.dataTransfer.setData("id", e.target.id);
  });
});

// Seleccionamos todas las casillas
const casillas = document.querySelectorAll(".casilla");
casillas.forEach((casilla) => {
  casilla.addEventListener("dragover", (e) => e.preventDefault());

  casilla.addEventListener("drop", (e) => {
    e.preventDefault();

    const tipo = e.dataTransfer.getData("id");
    const ficha = document.getElementById(tipo);

    const limite = limites[casilla.id]; // undefined si no tiene límite
    const fichasEnCasilla = casilla.querySelectorAll(".ficha").length;

    if (fichasEnCasilla && casilla.id == "Diferencia") {
      for (let i = 0; i < Diferencia.length; i++) {
        if (Diferencia[i] == ficha.id) {
          mostrarAlerta(`${ficha.id} ya fue colocado en la casilla`,"danger");
          return;
        }
      }
    }

    if (!fichasEnCasilla && casilla.id == "Semejanza") {
      Igualdad = ficha.id;
    }
    if (fichasEnCasilla && casilla.id == "Trio") {
      Trio = ficha.id;
    }
    if (casilla.id == "Diferencia") {
      Diferencia[fichasEnCasilla] = ficha.id;
    }

    //Rechazar ficha si
    // Maximo numero de fichas en la casilla
    //Tipo de ficha incorrecto
    if (fichasEnCasilla >= limite) {
      mostrarAlerta(`Esta casilla ya alcanzó su límite de ${limite} fichas!`, "danger");
      return;
    }
    if (fichasEnCasilla && casilla.id == "Semejanza") {
      if (Igualdad != ficha.id) {
       mostrarAlerta(`Solo ${Igualdad} pueden colocarse en esta castilla`, "danger");
        return;
      }
    }
    if (fichasEnCasilla && casilla.id == "Trio") {
      if (Trio != ficha.id) {
        mostrarAlerta(`Solo ${Trio} pueden colocarse en esta castilla`, "danger");
        return;
      }
    }

    // Si viene de la barra inferior, clonamos
    if (ficha.parentElement.classList.contains("barra_inferior")) {
      const copia = ficha.cloneNode(true);
      copia.id = tipo + "-" + Date.now();
      copia.addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
      });
      casilla.appendChild(copia);
    } else {
      // Si viene de otra casilla, la movemos
      casilla.appendChild(ficha);
    }

    //Informacion de fondo
    console.log("Casilla: " + casilla.id);
    console.log("Limite: " + limite);
    console.log("Num Fichas: " + fichasEnCasilla);
    console.log("Ficha: " + ficha.id);
  });
});

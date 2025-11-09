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
          mostrarAlerta(`${ficha.id} ya fue colocado en la casilla`, "danger");
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
      mostrarAlerta(
        `Esta casilla ya alcanzó su límite de ${limite} fichas!`,
        "danger"
      );
      return;
    }
    if (fichasEnCasilla && casilla.id == "Semejanza") {
      if (Igualdad != ficha.id) {
        mostrarAlerta(
          `Solo ${Igualdad} pueden colocarse en esta castilla`,
          "danger"
        );
        return;
      }
    }
    if (fichasEnCasilla && casilla.id == "Trio") {
      if (Trio != ficha.id) {
        mostrarAlerta(
          `Solo ${Trio} pueden colocarse en esta castilla`,
          "danger"
        );
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
    const fichasEnCasillaFinal = casilla.querySelectorAll(".ficha").length;
    console.log("Fichas reales en", casilla.id, ":", fichasEnCasillaFinal);

    actualizarPuntos();
    //Informacion de fondo
    console.log("Casilla: " + casilla.id);
    console.log("Limite: " + limite);
    console.log("Num Fichas: " + fichasEnCasilla);
    console.log("Ficha: " + ficha.id);
  });
});

function calcularPuntos() {
  let total = 0;

  const casillas = document.querySelectorAll(".casilla");

  casillas.forEach((casilla) => {
    const fichasNodo = casilla.querySelectorAll(".ficha"); // Lista de fichas en esta casilla
    const cantidad = fichasNodo.length; // Cantidad de fichas

    // Puntaje base según la casilla
    switch (casilla.id) {
      case "Semejanza":
        total += [0, 2, 4, 8, 12, 18, 24][cantidad] || 0;
        break;

      case "Trio":
        if (cantidad === 3) total += 7;
        break;

      case "Rey":
        if (cantidad === 1) total += 7;
        break;

      case "Diferencia":
        total += [0, 1, 3, 6, 10, 15, 21][cantidad] || 0;
        break;

      case "Amor":
        let arch = 0,
          ubuntu = 0,
          mint = 0,
          fedora = 0,
          debian = 0,
          suse = 0;
        let puntosAmor = 0;

        // Contamos cuántas fichas de cada tipo hay en Amor
        fichasNodo.forEach((f) => {
          const tipo = f.id.split("-")[1]; // ficha-arch → "arch"
          switch (tipo) {
            case "arch":
              arch++;
              break;
            case "ubuntu":
              ubuntu++;
              break;
            case "mint":
              mint++;
              break;
            case "fedora":
              fedora++;
              break;
            case "debian":
              debian++;
              break;
            case "suse":
              suse++;
              break;
          }
        });

        // Cada par (2, 4, 6...) del mismo tipo suma 5 puntos
        [arch, ubuntu, mint, fedora, debian, suse].forEach((contador) => {
          if (contador >= 2) {
            const parejas = Math.floor(contador / 2); // 2→1, 3→1, 4→2, etc.
            puntosAmor += parejas * 5;
          }
        });

        total += puntosAmor;
        break;

      case "Isla":
        if (cantidad === 1) total += 7;
        break;

      case "Rio":
        total += cantidad * 1;
        break;
    }

    // 🔸 BONUS: cada ficha Arch en el tablero suma +1 extra
    fichasNodo.forEach((f) => {
      if (f.id.includes("ficha-arch")) {
        total += 1;
      }
    });
  });

  return { total };
}

function actualizarPuntos() {
  const { total } = calcularPuntos();
  const puntosElemento = document.querySelector(".puntos");
  if (puntosElemento) {
    puntosElemento.textContent = total;
  }
}

const form = document.querySelector("form");
form.addEventListener("submit", () => {
  const puntos = document.querySelector(".puntos").textContent;
  document.getElementById("puntosInput").value = puntos;
});

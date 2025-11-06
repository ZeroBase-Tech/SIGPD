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

function calcularPuntos() {
  let total = 0;

   const casillas = document.querySelectorAll(".casilla");

  casillas.forEach(casilla => {
    const fichas = casilla.querySelectorAll(".ficha").length;

    switch (casilla.id) {
      case "Semejanza":
        total += [0, 2, 4, 8, 12, 18, 24][fichas] || 0;
        break;

      case "Trio":
        if (fichas === 3) total += 7;
        break;

      case "Rey":
        if (fichas === 1) total += 7;
        break;

      case "Diferencia":
        total += [0, 1, 3, 6, 10, 15, 21][fichas] || 0;
        break;

      case "Amor":
        const pares = Math.floor(fichas / 2);
        total += pares * 5;;
        break;

      case "Isla":
        if (fichas === 1) total += 7;
        break;

      case "Rio":
        total += fichas * 1;
        break;
    }
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

//Logica del Tablero

let Diferencia = new Array(6);
let Igualdad;
let Trio;
const limites = {
	Semejanza: 6,
	Rey: 1,
	Trio: 3,
	Diferencia: 6,
	Isla: 1,
	Amor: 12,
	Rio: 12,
};

const fichas = document.querySelectorAll(".ficha");
fichas.forEach((ficha) => {
	ficha.addEventListener("dragstart", (e) => {
		e.dataTransfer.setData("id", e.target.id);
	});
});

const casillas = document.querySelectorAll(".casilla");
casillas.forEach((casilla) => {
	casilla.addEventListener("dragover", (e) => e.preventDefault());
	casilla.addEventListener("drop", (e) => {
		e.preventDefault();
		const tipo = e.dataTransfer.getData("id");
		const ficha = document.getElementById(tipo);
		const limite = limites[casilla.id];
		const fichasEnCasilla = casilla.querySelectorAll(".ficha").length;

		if (fichasEnCasilla && casilla.id == "Diferencia"){
			for (let i = 0; i < Diferencia.length; i++){
				if(Diferencia[i] == ficha.id) {
					mostrarAlerta(`${ficha.id} ya fue colocado en la casilla`, "danger");
					return;
				}
			}
		}
		if (fichasEnCasilla >= limite){
			mostrarAlerta(`Esta casilla ya alcanzo su limite de ${limite} fichas!`, "danger");
			return;
		}
		if (fichasEnCasilla && casilla.id == "Semejanza"){
			if (Igualdad != ficha.id) {
			mostrarAlerta(`Solo ${Igualdad} pueden colocarse en esta casilla`);
			return;
			}
		}

		if (!fichasEnCasilla && casilla.id == "Semejanza"){
			Igualdad = ficha.id;
		}
		if (!fichasEnCasilla && casilla.id == "Trio"){
			Trio = ficha.id
		}
		if (casilla.id == "Diferencia"){
			Diferencia[fichasEnCasilla] = ficha.id
		}

		if (ficha.parentElement.classList.contains("barra_inferior")) {
			const copia = ficha.cloneNode(true);
			copia.id = tipo + "-" + Date.now();
			copia.addEventListener("dragstart", (e) => {
				e.dataTransfer.setData("id", e.target.id);
			});
			casilla.appendChild(copia);
		}else{
			casilla.appendChild(ficha);
		}
		const fichasEnCasillaFinal = casilla.querySelectorAll(".ficha").length;
		console.log("Fichas reales en", casilla.id, ":", fichasEnCasillaFinal);
		actualizarPuntos();
		
		//Informacion de Fondo
		console.log("Casilla: " + casilla.id);
		console.log("Limite: " + limite);
		console.log("Num Fichas: " + fichasEnCasilla);
		console.log("Ficha: " + ficha.id);
	});
});

// Programacion Orientada a Objetos

// Clases

class Computadora {
    constructor(tipo, marca, memoriaRAM, capacidadDiscoDuro) {
        this.tipo = tipo;
        this.marca = marca;
        this.memoriaRAM = memoriaRAM;
        this.capacidadDiscoDuro = capacidadDiscoDuro;
    }

    toString() {
        return `Tipo: ${this.tipo}, Marca: ${this.marca}, Memoria RAM: ${this.memoriaRAM}, Almacenamiento: ${this.capacidadDiscoDuro}`
    }

    getMarca() {
        return this.marca;
    }
}

const laptop = new Computadora(tipo = "laptop", "apple", "8 GB", "512 GB")

console.log(laptop.toString())

// Herencia

class Laptop extends Computadora {
    constructor(marca, memoriaRAM, capacidadDiscoDuro) {
        super("Laptop", marca, memoriaRAM, capacidadDiscoDuro)
    }
}

const laptop2 = new Laptop(marca = "Dell", "32 GB", "256 GB");

console.log(laptop2.toString())
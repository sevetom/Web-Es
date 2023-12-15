function Computer(processore, disco, ram) {
    this.processore = processore;
    this.disco = disco;
    this.ram = ram;
}

Computer.prototype.infoComputerConsole = function() {
    console.log("Processore: " + this.processore + "\nDisco: " + this.disco + "\nRAM: " + this.ram);
}

Computer.prototype.infoComputerDOM = function(id) {
    document.getElementById("id").innerHTML =
        "<p>Processore: " + this.processore + "</p>" +
        "<p>Disco: " + this.disco + "</p>" +
        "<p>RAM: " + this.ram + "</p>";
}

class Computer2 {
    constructor(processore, disco, ram) {
        this.processore = processore;
        this.disco = disco;
        this.ram = ram;
    }

    infoComputerConsole = function() {
        console.log("Processore: " + this.processore + "\nDisco: " + this.disco + "\nRAM: " + this.ram);
    }

    infoComputerDOM = function(id) {
        document.getElementById("id").innerHTML =
            "<p>Processore: " + this.processore + "</p>" +
            "<p>Disco: " + this.disco + "</p>" +
            "<p>RAM: " + this.ram + "</p>";
    }
}

const mioPc = new Computer("i7", "500GB", "16GB");
mioPc.infoComputerConsole();
mioPc.infoComputerDOM("mioPc");

const mioPc2 = new Computer2("i5", "256GB", "8GB");
mioPc2.infoComputerConsole();
mioPc2.infoComputerDOM("mioPc2");